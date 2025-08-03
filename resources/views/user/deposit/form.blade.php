@include('user.layouts.header')
<!-- Main Content -->
<div class="depost-form-main">
    <h1 class="heading text-white">Fund Account</h1>
    <a href="#" class="view-pricing">VIEW PRICING</a>

    <div class="fund-card">
        <div class="input-group">
            <div class="input-label">Amount (USD)</div>
            <input type="text" class="amount-input" value="0">
        </div>

        <div class="input-group">
            <div class="input-label">Account</div>
            <select class="select-account">
                <option>Trading Balanceee</option>
                <option>Holding Balance</option>
                <option>Staking Balance</option>
            </select>
        </div>

        <button class="withdrawal-btn">Proceed</button>
    </div>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const closedTab = document.getElementById('closed-tab');
          const activeTab = document.getElementById('active-tab');
          const statusMessage = document.getElementById('status-message');
  
          closedTab.addEventListener('click', function() {
              closedTab.classList.add('active');
              activeTab.classList.remove('active');
              statusMessage.textContent = 'NO CLOSED TRADES';
          });
  
          activeTab.addEventListener('click', function() {
              activeTab.classList.add('active');
              closedTab.classList.remove('active');
              statusMessage.textContent = 'NO OPEN TRADES';
          });
  
              // Handle sidebar visibility and dropdowns
      document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
  
      // Open all dropdowns when the sidebar is shown
      sidebar.addEventListener('shown.bs.offcanvas', () => {
          document.querySelectorAll('.dropdown-content').forEach(content => {
              content.classList.add('active');
              const arrow = content.previousElementSibling.querySelector('.arrow');
              if (arrow) {
                  arrow.classList.add('up');
              }
          });
      });
  
      // Optional: Close all dropdowns when the sidebar is hidden
      sidebar.addEventListener('hidden.bs.offcanvas', () => {
          document.querySelectorAll('.dropdown-content').forEach(content => {
              content.classList.remove('active');
              const arrow = content.previousElementSibling.querySelector('.arrow');
              if (arrow) {
                  arrow.classList.remove('up');
              }
          });
      });
  
      // Dropdown button functionality
      document.querySelectorAll('.dropdown-btn').forEach(button => {
          button.addEventListener('click', () => {
              const dropdown = button.nextElementSibling;
              const arrow = button.querySelector('.arrow');
              
              // Close all other dropdowns
              document.querySelectorAll('.dropdown-content').forEach(content => {
                  if (content !== dropdown && content.classList.contains('active')) {
                      content.classList.remove('active');
                      content.previousElementSibling.querySelector('.arrow').classList.remove('up');
                  }
              });
  
              // Toggle current dropdown
              dropdown.classList.toggle('active');
              arrow.classList.toggle('up');
          });
      });
  });
  
          
</script>
</body>

</html>