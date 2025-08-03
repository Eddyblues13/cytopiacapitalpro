<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use App\Models\User\Profit;
use App\Models\Document;
use App\Mail\sendUserEmail;
use App\Models\StockHistory;
use App\Models\TradeHistory;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\AccountBalance;
use App\Models\User\Withdrawal;
use App\Models\User\MiningBalance;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotificationMail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with a list of all users.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        // Fetch total deposits
        $total_deposits = Deposit::sum('amount');

        // Fetch pending deposits
        $pending_deposits_sum = Deposit::where('status', 'pending')->sum('amount');

        // Fetch total withdrawals
        $total_withdrawals = Withdrawal::sum('amount');

        // Fetch pending withdrawals
        $pending_withdrawals_sum = Withdrawal::where('status', 'pending')->sum('amount');

        // Fetch total users
        $total_users = User::count();

        // Fetch suspended users
        $suspended_users = User::where('id_verification', 'suspended')->count();

        // Pass data to the view
        return view('admin.home', [
            'total_deposits' => $total_deposits,
            'pending_deposits_sum' => $pending_deposits_sum,
            'total_withdrawals' => $total_withdrawals,
            'pending_withdrawals_sum' => $pending_withdrawals_sum,
            'total_users' => $total_users,
            'suspended_users' => $suspended_users,
        ]);
    }


    public function manageUsersPage()
    {
        $data['users'] = User::get();


        return view('admin.manage_users', $data);
    }

    public function getUsers(Request $request)
    {
        $validated = $request->validate([
            'num' => 'sometimes|integer|min:1|max:100',
            'search' => 'nullable|string|min:3|max:50',
            'order' => 'sometimes|in:name,email,created_at'
        ]);

        $users = User::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->orderBy($validated['order'] ?? 'created_at')
            ->take($validated['num'] ?? 10)
            ->get();

        $status = 200;
        if ($request->has('search') && empty($validated['search']) && !empty($request->search)) {
            $status = 201; // Invalid search length
        }

        return response()->json([
            'status' => $status,
            'data' => view('admin.users.partials.table_rows', compact('users'))->render()
        ]);
    }


    public function manageDepositsPage()
    {

        $data['deposits'] = User::join('deposits', 'users.id', '=', 'deposits.user_id')
            ->get(['users.email', 'users.name', 'deposits.*']);

        return view('admin.manage_deposit', $data);
    }

    public function manageWithdrawalsPage()
    {

        $data['withdrawals'] = User::join('withdrawals', 'users.id', '=', 'withdrawals.user_id')
            ->get(['users.email', 'users.name', 'withdrawals.*']);

        return view('admin.manage_withdrawal', $data);
    }


    public function viewDeposit($id)
    {

        $data['proof']  = Deposit::findOrFail($id);

        return view('admin.proof', $data);
    }

    public function processDeposit($id)
    {
        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->back()->with('message', 'Deposit not found!');
        }

        if ($deposit->status === '1') {
            return redirect()->back()->with('message', 'Deposit already processed.');
        }

        $deposit->status = '1'; // Mark as processed
        $deposit->save();

        return redirect()->back()->with('message', 'Deposit processed successfully!');
    }

    /**
     * Delete a deposit.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteDeposit($id)
    {
        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->back()->with('message', 'Deposit not found!');
        }

        $deposit->delete();

        return redirect()->back()->with('message', 'Deposit deleted successfully!');
    }

    public function viewWithdrawal($user_id, $withdrawal_id)
    {

        $data['withdrawal_details']  = Withdrawal::findOrFail($withdrawal_id);
        $data['user_details']  = User::findOrFail($user_id);


        return view('admin.user_withdrawal', $data);
    }


    public function manageKycPage()
    {
        $data['kyc'] = User::leftJoin('documents', 'users.id', '=', 'documents.user_id')
            ->get(['users.id as real_user_id', 'users.email', 'users.name', 'users.kyc_status', 'documents.*']);

        return view('admin.kyc', $data);
    }



    public function acceptKyc($id)
    {

        $user  = User::where('id', $id)->first();
        $user->kyc_status = 1;
        $user->save();
        return back()->with('message', 'Kyc Approved Successfully');
    }


    public function rejectKyc($id)
    {

        $user  = User::where('id', $id)->first();
        $user->kyc_status = 0;
        $user->save();
        return back()->with('message', 'Kyc Rejected Successfully');;
    }


    public function resetUserPassword($user_id)
    {

        $user = User::findOrFail($user_id);


        $user->update([
            'password' => Hash::make('user01236'),
        ]);

        return back()->with('message', 'Password has been reset successfully.');
    }


    public function clearAccount($id)
    {
        $user = User::find($id);
        $userId = User::find($id);

        // Clear Holding Balance
        HoldingBalance::where('user_id', $userId)->update(['amount' => 0]);

        // Clear Mining Balance
        MiningBalance::where('user_id', $userId)->update(['amount' => 0]);

        // Clear Referral Balance
        ReferralBalance::where('user_id', $userId)->update(['amount' => 0]);

        // Clear Staking Balance
        StakingBalance::where('user_id', $userId)->update(['amount' => 0]);

        // Clear Trading Balance
        TradingBalance::where('user_id', $userId)->update(['amount' => 0]);

        // Clear profit Balance
        Profit::where('user_id', $userId)->update(['amount' => 0]);

        return redirect()->back()->with('success', 'All balances cleared successfully.');
    }



    public function editUser(Request $request, User $user)
    {

        //$user = User::findOrFail($user_id);


        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',


        ]);

        $user->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
        ]);

        return back()->with('message', 'user updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return redirect()->route('manage.users.page')->with('message', 'User deleted successfully');
        }

        return redirect()->route('manage.users.page')->with('error', 'User not found');
    }


    public function newUser(Request $request)
    {

        $user = new User;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->account_type = "Joint Account";
        $user->password = Hash::make($request['password']);
        $user->save();

        return back()->with('message', 'New User Created  Successfully');
    }



    public function sendMail(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = $request->message;

        // Prepare the data for the email (escaping any HTML tags for safety)
        $data = "<p>" . e($message) . "</p>";

        $subject = $request->subject;

        // Send the email using the SendUserEmail mailable
        Mail::to($request->email)->send(new SendUserEmail($data, $subject));

        // Redirect back with a success message
        return back()->with('status', 'Email successfully sent!');
    }






    /**
     * Display the user profile.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function viewUser($id)
    {
        $data['user'] = User::where('id', $id)
            ->first();

        if (!$data['user']) {
            abort(404, 'User not found');
        }
        $user = User::find($id);

        // Decrypt the plain password
        $data['plain'] = $user->plain;

        // Fetch deposits for the user
        $data['deposits'] = Deposit::where('user_id', $id)->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', $id)
            ->where('status', 'pending')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', $id)
            ->where('status', 'successful')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', $id)
            ->where('status', 'pending')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', $id)
            ->where('status', 'successful')
            ->sum('amount');

        // Sum of holding balance
        $data['holding_balance'] = HoldingBalance::where('user_id', $id)
            ->sum('amount');

        // Sum of trading balance
        $data['trading_balance'] = TradingBalance::where('user_id', $id)
            ->sum('amount');

        // Sum of referral balance
        $data['referral_balance'] = ReferralBalance::where('user_id', $id)
            ->sum('amount');

        // Sum of trading balance
        $data['mining_balance'] = MiningBalance::where('user_id', $id)
            ->sum('amount');

        // Sum of profit
        $data['profit_balance'] = Profit::where('user_id', $id)
            ->sum('amount');



        // Total sum of all balances
        $data['total_balance'] =
            ($data['holding_balance'] ?? 0) +
            ($data['trading_balance'] ?? 0) +
            ($data['referral_balance'] ?? 0) +
            ($data['mining_balance'] ?? 0) +
            ($data['profit_balance'] ?? 0);






        return view('admin.user_data', $data);
    }







    /**
     * Open a new account.
     *
     * @return \Illuminate\View\View
     */
    public function sendEmailPage()
    {
        // Display form for opening a new account
        return view('admin.send_email');
    }

    public function sendEmail(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->input('email');
        $subject = $request->input('subject');
        $messageBody = $request->input('message');

        try {
            Mail::send([], [], function ($message) use ($email, $subject, $messageBody) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($messageBody, 'text/html');
            });

            return response()->json(['success' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email. Please try again.']);
        }
    }










    public function creditDebit(Request $request)
    {
        $type = $request['type'];
        $transactionType = $request['t_type'];
        $amount = $request['amount'];
        $userId = $request['user_id'];

        if ($type === 'Profit') {
            $creditDebit = new Profit;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $transactionType === 'Credit' ? $amount : -$amount;
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Profit');

            return back()->with('message', 'User Profit Topped Up Successfully');
        }

        if ($type === 'balance') {
            $creditDebit = new AccountBalance;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $transactionType === 'Credit' ? $amount : -$amount;
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Account Balance');

            return back()->with('message', 'Account Balance Updated Successfully');
        }

        if ($type === 'Deposit') {
            if ($transactionType === 'Debit') {
                return back()->with('message', 'Sorry, you cannot Debit a Deposit');
            }

            $creditDebit = new Deposit;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $amount;
            $creditDebit->deposit_type = 'Express Deposit';
            $creditDebit->payment_mode = 'Express Deposit';
            $creditDebit->proof = 'Express Deposit';
            $creditDebit->status = '1';
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Deposit');

            return back()->with('message', 'Deposit Added Successfully');
        }
    }

    /**
     * Send an email notification for the transaction.
     *
     * @param int $userId
     * @param string $transactionType
     * @param float $amount
     * @param string $transactionCategory
     * @return void
     */
    protected function sendTransactionEmail($userId, $transactionType, $amount, $transactionCategory)
    {
        $user = User::find($userId);

        if ($user) {
            $details = [
                'name' => $user->name,
                'transactionType' => $transactionType,
                'amount' => $amount,
                'transactionCategory' => $transactionCategory,
                'date' => now()->toDateTimeString(),
            ];

            Mail::to($user->email)->send(new TransactionNotificationMail($details));
        }
    }




    // Method to show the profile update form
    public function editProfile()
    {
        // Retrieve the authenticated admin using the 'admin' guard
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile', compact('admin')); // Profile Blade file
    }

    // Method to handle the profile update
    public function updateProfile(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Update the profile of the authenticated admin
        $admin = Auth::guard('admin')->user();
        $admin->name = $request->firstname;
        // $admin->middlename = $request->middlename;
        // $admin->lastname = $request->lastname;
        // $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    // Method to handle password update
    public function updatePassword(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Retrieve the authenticated admin
        $admin = Auth::guard('admin')->user();

        // Check if the old password matches
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Old password is incorrect.'
            ], 422);
        }

        // Update the new password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully!'
        ]);
    }



    public function showResetPasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.admin_change_user_password', compact('user'));
    }


    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'id' => 'required|exists:users,id',
        ]);

        // Find user by ID
        $user = User::findOrFail($request->id);

        // Update user password
        $user->password = Hash::make($request->password);
        $user->save();

        // Return success message
        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.',
        ]);
    }


    public function impersonate(User $user)
    {
        // Store the original user's ID in the session (if not already stored)
        if (!session()->has('impersonate')) {
            session()->put('impersonate', Auth::id());
        }
        $data['user'] = $user;

        // Impersonate the specified user
        Auth::loginUsingId($user->id);

        // Get deposits and sums for the impersonated user
        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =
            $data['holdingBalance'] +
            $data['stakingBalance'] +
            $data['tradingBalance'] +
            $data['referralBalance'] +
            $data['profit'];


        $data['openTrades'] = $user->trades()
            ->where('status', 'active')
            ->orderBy('entry_date', 'desc')
            ->get();

        $data['closedTrades'] = $user->trades()
            ->where('status', 'closed')
            ->orderBy('exit_date', 'desc')
            ->get();


        // Redirect to the user's home page with the relevant data
        return view('user.home', $data)->with('message', 'You are logged in as ' . $user->first_name . ' ' . $user->last_name);
    }


    public function leaveImpersonate()
    {
        // Check if the session has an 'impersonate' value
        if (session()->has('impersonate')) {
            // Retrieve the original user's ID from the session
            $originalUserId = session()->get('impersonate');

            // Log in as the original user
            Auth::loginUsingId($originalUserId);

            // Forget the impersonation session data
            session()->forget('impersonate');


            $data['users'] = User::select('users.id', 'users.name', 'users.email', 'users.created_at')
                ->leftJoin('account_balances', 'users.id', '=', 'account_balances.user_id')
                ->leftJoin('profits', 'users.id', '=', 'profits.user_id')
                ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at')
                ->selectRaw('SUM(account_balances.amount) as balance_sum, SUM(profits.amount) as profit_sum')
                ->get();
            // Sum of account balance
            $data['balance_sum'] = AccountBalance::sum('amount');

            // Sum of pending deposits
            $data['pending_deposits_sum'] = Deposit::where('status', 'pending')->sum('amount');

            // Sum of successful deposits
            $data['total_deposits'] = Deposit::sum('amount');

            // Sum of pending withdrawals
            $data['pending_withdrawals_sum'] = Withdrawal::where('status', 'pending')->sum('amount');

            // Sum of successful withdrawals
            $data['total_withdrawals'] = Withdrawal::sum('amount');

            // sum total users
            $data['total_users'] = User::count();

            // sum total users
            $data['suspended_users'] = User::where('account_suspended', '1')->count();




            // Redirect to the original user's dashboard or home page
            return redirect()->route('admin.home', $data)->with('message', 'You have returned to your original account.');
        }

        // If no impersonation is happening, redirect to home
        return redirect()->route('admin.home')->with('message', 'No impersonation found.');
    }




    public function addSignalStrength(Request $request)
    {
        // Validate the input
        $request->validate([
            'signal_strength' => 'required|integer|min:0|max:100',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the user by ID
        $user = User::find($request->user_id);

        if ($user) {
            // Update the user's signal_strength
            $user->signal_strength = $request->signal_strength;
            $user->save();

            return redirect()->back()->with('message', 'Signal strength updated successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }


    public function addTradePage()
    {
        //$stockHistories = StockHistory::with('user')->get(); // Include related user data
        return view('admin.trades');
    }







    public function adminUpdateUser(Request $request)
    {
        $user = User::find($request->user_id);

        if ($request->hasFile('photo')) {
            // Validate the request
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);

            // Handle file upload
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension(); // Generate unique filename
            $destinationPath = public_path('uploads/photos/'); // Define destination path

            // Move the file to the destination folder
            $photo->move($destinationPath, $filename);

            // Save the file path to the database
            $user->update(['profile_photo' => 'uploads/photos/' . $filename]);

            return response()->json([
                'success' => true,
                'message' => 'Photo updated successfully!',
                'new_value' => asset('uploads/photos/' . $filename), // Return the full URL of the new photo
                'redirect' => route('account.photo'), // Redirect to the user's profile page
            ]);
        } elseif ($request->field === 'password' || $request->field === 'plain') {
            // Handle password and plain fields
            $field = $request->field;
            $value = $request->value;

            if ($field === 'password') {
                $user->$field = Hash::make($value); // Hash the password
            } elseif ($field === 'plain') {
                $user->$field = encrypt($value); // Encrypt the plain password
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully!',
            ]);
        } else {
            // Handle regular fields
            $field = $request->field;
            $user->$field = $request->value;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
            ]);
        }
    }
}
