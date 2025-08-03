<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TraderController extends Controller
{
    protected $cloudinary;
    protected $uploadApi;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);
        $this->uploadApi = new UploadApi();
    }

    /**
     * Display a listing of the resource with pagination
     */
    public function index()
    {
        $traders = Trader::latest()->paginate(10);
        return view('admin.traders.index', compact('traders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.traders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'followers' => 'required|integer|min:0',
            'return_rate' => 'required|numeric|min:0|max:100',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gt:min_amount',
            'profit_share' => 'required|numeric|min:0|max:100',
            'is_verified' => 'required|boolean',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validated = $validator->validated();

            // Handle picture upload to Cloudinary
            $uploadResult = $this->uploadApi->upload(
                $request->file('picture')->getRealPath(),
                [
                    'folder' => 'traders/profiles',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill',
                        'gravity' => 'face',
                        'quality' => 'auto'
                    ]
                ]
            );

            $trader = Trader::create([
                'name' => $validated['name'],
                'followers' => $validated['followers'],
                'return_rate' => $validated['return_rate'],
                'min_amount' => $validated['min_amount'],
                'max_amount' => $validated['max_amount'],
                'profit_share' => $validated['profit_share'],
                'is_verified' => $validated['is_verified'],
                'picture_url' => $uploadResult['secure_url'],
                'picture_public_id' => $uploadResult['public_id'],
            ]);

            // return redirect()->route('traders.index')
            //     ->with('success', 'Trader created successfully!');
            return response()->json([
                'success' => true,
                'message' => 'Trader created successfully!',
                'redirect_url' => route('traders.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Trader creation failed: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Trader creation failed. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trader $trader)
    {
        return view('admin.traders.show', compact('trader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trader $trader)
    {
        return view('admin.traders.edit', compact('trader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trader $trader)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'followers' => 'required|integer|min:0',
            'return_rate' => 'required|numeric|min:0|max:100',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gt:min_amount',
            'profit_share' => 'required|numeric|min:0|max:100',
            'is_verified' => 'required|boolean',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_picture' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validated = $validator->validated();
            $updateData = [
                'name' => $validated['name'],
                'followers' => $validated['followers'],
                'return_rate' => $validated['return_rate'],
                'min_amount' => $validated['min_amount'],
                'max_amount' => $validated['max_amount'],
                'profit_share' => $validated['profit_share'],
                'is_verified' => $validated['is_verified'],
            ];

            // Handle picture removal or update
            if ($request->has('remove_picture') && $request->remove_picture) {
                $this->deleteCloudinaryImage($trader->picture_public_id);
                $updateData['picture_url'] = null;
                $updateData['picture_public_id'] = null;
            } elseif ($request->hasFile('picture')) {
                $this->deleteCloudinaryImage($trader->picture_public_id);

                $uploadResult = $this->uploadApi->upload(
                    $request->file('picture')->getRealPath(),
                    [
                        'folder' => 'traders/profiles',
                        'transformation' => [
                            'width' => 400,
                            'height' => 400,
                            'crop' => 'fill',
                            'gravity' => 'face',
                            'quality' => 'auto'
                        ]
                    ]
                );

                $updateData['picture_url'] = $uploadResult['secure_url'];
                $updateData['picture_public_id'] = $uploadResult['public_id'];
            }

            $trader->update($updateData);

            // return redirect()->route('traders.index')
            //     ->with('success', 'Trader updated successfully!');

            return response()->json([
                'success' => true,
                'message' => 'Trader updated successfully!',
                'redirect_url' => route('traders.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Trader update failed: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Trader update failed. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trader $trader)
    {
        try {
            // Delete picture from Cloudinary if exists
            $this->deleteCloudinaryImage($trader->picture_public_id);

            $trader->delete();

            return redirect()->route('admin.traders.index')
                ->with('success', 'Trader deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Trader deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete trader. Please try again.');
        }
    }

    /**
     * Helper method to delete image from Cloudinary
     */
    protected function deleteCloudinaryImage($publicId)
    {
        if ($publicId) {
            try {
                $this->uploadApi->destroy($publicId);
            } catch (\Exception $e) {
                Log::error("Failed to delete Cloudinary image: " . $e->getMessage());
                throw $e;
            }
        }
    }
}
