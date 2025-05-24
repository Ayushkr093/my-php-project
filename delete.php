<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Employee Record</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    };
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300 font-sans">
  <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 transition-all">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
            <i class="fas fa-trash-alt mr-3 text-red-500"></i>
            Delete Employee Record
          </h1>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">This action cannot be undone.</p>
        </div>
        <!-- Dark mode toggle -->
        <div class="flex items-center space-x-2">
          <input type="checkbox" id="theme-toggle" class="hidden">
          <label for="theme-toggle" class="relative inline-block w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full cursor-pointer transition-colors">
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transform transition-transform"></span>
          </label>
        </div>
      </div>

      <!-- Delete Confirmation -->
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
        
        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400 p-4 rounded-lg">
          <div class="flex">
            <div class="flex-shrink-0">
              <i class="fas fa-exclamation-circle h-5 w-5 text-red-500 dark:text-red-400"></i>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Are you sure you want to delete this employee?</h3>
              <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                <p>This will permanently remove all employee data from the system.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between pt-4">
          <a href="index.php"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-sm font-semibold transition">
            <i class="fas fa-times"></i> Cancel
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-semibold transition">
            <i class="fas fa-trash-alt"></i> Confirm Delete
          </button>
        </div>
      </form>
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