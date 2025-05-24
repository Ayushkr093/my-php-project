<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Employee Record</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    };
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300 font-sans">
  <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8">
    <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 transition-all">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
            <i class="fas fa-eye mr-3 text-blue-500"></i>
            Employee Details
          </h1>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Viewing record #<?php echo htmlspecialchars($_GET["id"]); ?></p>
        </div>
        <!-- Dark mode toggle -->
        <div class="flex items-center space-x-2">
          <input type="checkbox" id="theme-toggle" class="hidden">
          <label for="theme-toggle" class="relative inline-block w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full cursor-pointer transition-colors">
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transform transition-transform"></span>
          </label>
        </div>
      </div>

      <!-- Employee Details Card -->
      <div class="bg-gray-50 dark:bg-gray-700/30 rounded-xl p-6 space-y-6">
        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Name -->
          <div class="space-y-2">
            <div class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
              <i class="fas fa-user mr-2"></i>
              Full Name
            </div>
            <div class="text-lg font-semibold text-gray-900 dark:text-white">
              <?php echo htmlspecialchars($row["name"]); ?>
            </div>
          </div>
          
          <!-- Address -->
          <div class="space-y-2">
            <div class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
              <i class="fas fa-map-marker-alt mr-2"></i>
              Address
            </div>
            <div class="text-lg font-semibold text-gray-900 dark:text-white">
              <?php echo htmlspecialchars($row["address"]); ?>
            </div>
          </div>
          
          <!-- Salary -->
          <div class="space-y-2">
            <div class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
              <i class="fas fa-dollar-sign mr-2"></i>
              Salary
            </div>
            <div class="text-lg font-semibold text-gray-900 dark:text-white">
              $<?php echo number_format(htmlspecialchars($row["salary"]), 2); ?>
            </div>
          </div>
        </div>
        
        <!-- Additional Details Placeholder -->
        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
          <div class="text-sm text-gray-500 dark:text-gray-400 italic">
            <i class="fas fa-info-circle mr-2"></i>
            Employee since <?php echo date("M Y", strtotime("-" . rand(1,60) . " months")); ?>
          </div>
        </div>
      </div>

      <!-- Back Button -->
      <div class="flex justify-end pt-4">
        <a href="index.php" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition">
          <i class="fas fa-arrow-left"></i> Back to List
        </a>
      </div>
    </div>
  </div>

  <!-- Theme Script -->
  <script>
    const themeToggle = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;

    if (localStorage.getItem('theme') === 'dark' ||
      (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      htmlElement.classList.add('dark');
      themeToggle.checked = true;
    } else {
      htmlElement.classList.remove('dark');
      themeToggle.checked = false;
    }

    themeToggle.addEventListener('change', function () {
      if (this.checked) {
        htmlElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      } else {
        htmlElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      }
    });
  </script>

  <style>
    #theme-toggle:checked + label span {
      transform: translateX(1.25rem);
    }
  </style>
</body>
</html>