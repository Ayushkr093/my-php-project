<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
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
  <title>Update Employee Record</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            }
          }
        }
      }
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
            <i class="fas fa-user-edit mr-3 text-blue-500"></i>
            Update Employee Record
          </h1>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Edit the form below to update employee #<?php echo htmlspecialchars($id); ?></p>
        </div>
        <!-- Dark mode toggle -->
        <div class="flex items-center space-x-2">
          <input type="checkbox" id="theme-toggle" class="hidden">
          <label for="theme-toggle" class="relative inline-block w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full cursor-pointer transition-colors">
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transform transition-transform"></span>
          </label>
        </div>
      </div>

      <!-- Form -->
      <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" class="space-y-6">
        <!-- Full Name -->
        <div class="animate-fade-in">
          <label for="name" class="block text-sm font-medium mb-1">Full Name</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
              <i class="fas fa-user"></i>
            </div>
            <input type="text" name="name" id="name"
              class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($name_err)) ? 'border-red-500' : ''; ?>"
              value="<?php echo htmlspecialchars($name); ?>"
              maxlength="100"
              required>
          </div>
          <?php if (!empty($name_err)): ?>
            <p class="text-sm text-red-600 mt-1 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i> <?php echo $name_err; ?>
            </p>
          <?php endif; ?>
        </div>

        <!-- Address -->
        <div class="animate-fade-in" style="animation-delay: 0.1s">
          <label for="address" class="block text-sm font-medium mb-1">Address</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-start pt-3 pl-3 pointer-events-none text-gray-400">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <textarea name="address" id="address" rows="4"
              class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($address_err)) ? 'border-red-500' : ''; ?>"
              maxlength="255"
              required><?php echo htmlspecialchars($address); ?></textarea>
          </div>
          <?php if (!empty($address_err)): ?>
            <p class="text-sm text-red-600 mt-1 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i> <?php echo $address_err; ?>
            </p>
          <?php endif; ?>
        </div>

        <!-- Salary -->
        <div class="animate-fade-in" style="animation-delay: 0.2s">
          <label for="salary" class="block text-sm font-medium mb-1">Salary</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <input type="text" name="salary" id="salary"
              class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($salary_err)) ? 'border-red-500' : ''; ?>"
              value="<?php echo htmlspecialchars($salary); ?>"
              inputmode="numeric"
              pattern="\d*"
              maxlength="12"
              required>
          </div>
          <?php if (!empty($salary_err)): ?>
            <p class="text-sm text-red-600 mt-1 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i> <?php echo $salary_err; ?>
            </p>
          <?php endif; ?>
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>"/>

        <!-- Buttons -->
        <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
          <a href="index.php"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-sm font-semibold transition">
            <i class="fas fa-times"></i> Cancel
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition">
            <i class="fas fa-save"></i> Update Record
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
    
    .animate-fade-in {
      animation: fadeIn 0.5s ease-in-out forwards;
      opacity: 0;
    }
  </style>
</body>
</html>