<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!preg_match('/^[a-zA-Z\s\-\.\']+$/', $input_name)){
        $name_err = "Please enter a valid name (only letters, spaces, hyphens, dots and apostrophes allowed).";
    } elseif(strlen($input_name) > 100) {
        $name_err = "Name cannot exceed 100 characters.";
    } else{
        $name = $input_name;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } elseif(strlen($input_address) > 255) {
        $address_err = "Address cannot exceed 255 characters.";
    } else{
        $address = $input_address;
    }

    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!preg_match('/^\d+$/', $input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } elseif($input_salary > 9999999) {
        $salary_err = "Salary cannot exceed 9,999,999.";
    } else{
        $salary = $input_salary;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_address, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>


<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Employee Record</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
    <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 transition-all duration-300 transform hover:shadow-2xl dark:hover:shadow-gray-700/50">
      <!-- Header with Progress Indicator -->
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
              <i class="fas fa-user-plus mr-3 text-blue-500 animate-pulse-slow"></i>
              Create Employee Record
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Please complete all required fields marked with <span class="text-red-500">*</span></p>
          </div>
          <div class="flex items-center space-x-2">
            <button id="help-btn" class="p-2 text-gray-500 hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
              <i class="fas fa-question-circle text-lg"></i>
            </button>
            <input type="checkbox" id="theme-toggle" class="hidden">
            <label for="theme-toggle" class="relative inline-block w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full cursor-pointer transition-colors">
              <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transform transition-transform"></span>
            </label>
          </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="pt-2">
          <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
            <span>Progress</span>
            <span id="progress-percentage">0%</span>
          </div>
          <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
          </div>
        </div>
      </div>

      <!-- Form -->
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-6 animate-fade-in">
        <!-- Full Name with Character Counter -->
        <div>
          <label for="name" class="block text-sm font-medium mb-1">
            Full Name <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
              <i class="fas fa-user"></i>
            </div>
            <input type="text" name="name" id="name"
              class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($name_err)) ? 'border-red-500' : ''; ?>"
              value="<?php echo htmlspecialchars($name); ?>" 
              maxlength="100" 
              required
              oninput="updateProgress()">
            <div class="absolute right-2 bottom-2 text-xs text-gray-400">
              <span id="name-counter">0</span>/100
            </div>
          </div>
          <p class="text-sm text-red-600 mt-1"><?php echo $name_err; ?></p>
        </div>

        <!-- Address with Geolocation Button -->
        <div>
          <label for="address" class="block text-sm font-medium mb-1">
            Address <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-start pt-3 pl-3 pointer-events-none text-gray-400">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <textarea name="address" id="address" rows="4"
              class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($address_err)) ? 'border-red-500' : ''; ?>"
              maxlength="255" 
              required
              oninput="updateProgress()"><?php echo htmlspecialchars($address); ?></textarea>
            <button type="button" id="geolocate-btn" class="absolute right-2 bottom-2 p-1 text-gray-500 hover:text-blue-500 dark:hover:text-blue-400 transition-colors" title="Use current location">
              <i class="fas fa-location-arrow"></i>
            </button>
            <div class="absolute right-2 top-2 text-xs text-gray-400">
              <span id="address-counter">0</span>/255
            </div>
          </div>
          <p class="text-sm text-red-600 mt-1"><?php echo $address_err; ?></p>
        </div>

        <!-- Salary with Currency Selector -->
        <div>
          <label for="salary" class="block text-sm font-medium mb-1">
            Salary <span class="text-red-500">*</span>
          </label>
          <div class="flex items-center gap-2">
            <div class="relative flex-1">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <span id="currency-symbol">$</span>
              </div>
              <input type="text" name="salary" id="salary"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500 <?php echo (!empty($salary_err)) ? 'border-red-500' : ''; ?>"
                value="<?php echo htmlspecialchars($salary); ?>" 
                inputmode="numeric" 
                pattern="[0-9]*" 
                maxlength="12" 
                required
                oninput="updateProgress()">
              <div class="absolute right-2 top-2">
                <button type="button" id="currency-btn" class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">
                  USD <i class="fas fa-chevron-down ml-1 text-xs"></i>
                </button>
              </div>
            </div>
            <div class="relative">
              <select id="salary-period" name="salary_period" class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm h-[42px]">
                <option value="hour">per hour</option>
                <option value="day">per day</option>
                <option value="week">per week</option>
                <option value="month" selected>per month</option>
                <option value="year">per year</option>
              </select>
            </div>
          </div>
          <p class="text-sm text-red-600 mt-1"><?php echo $salary_err; ?></p>
          <div id="salary-conversion" class="text-xs text-gray-500 dark:text-gray-400 mt-1"></div>
        </div>

        <!-- Form Submission -->
        <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
          <a href="index.php"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-sm font-semibold transition">
            <i class="fas fa-arrow-left"></i> Cancel
          </a>

          <div class="flex gap-4">
            <button type="reset"
              class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold transition">
              <i class="fas fa-undo"></i> Reset
            </button>
            <button type="submit" id="submit-btn"
              class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed"
              disabled>
              <i class="fas fa-save"></i> Create Employee
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Help Modal -->
  <div id="help-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
          <i class="fas fa-question-circle text-blue-500 mr-2"></i>
          Help Center
        </h3>
        <button id="close-help" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
        <p><span class="font-semibold">Full Name:</span> Enter the employee's full legal name.</p>
        <p><span class="font-semibold">Address:</span> Provide the complete residential address.</p>
        <p><span class="font-semibold">Salary:</span> Enter the base salary amount. Use the dropdown to select currency and payment period.</p>
      </div>
      <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
        <button id="got-it-btn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
          Got it!
        </button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    // Theme Toggle
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

    // Help Modal
    const helpBtn = document.getElementById('help-btn');
    const helpModal = document.getElementById('help-modal');
    const closeHelp = document.getElementById('close-help');
    const gotItBtn = document.getElementById('got-it-btn');

    helpBtn.addEventListener('click', () => {
      helpModal.classList.remove('hidden');
      setTimeout(() => {
        helpModal.querySelector('div').classList.remove('scale-95', 'opacity-0');
      }, 10);
    });

    [closeHelp, gotItBtn].forEach(btn => {
      btn.addEventListener('click', () => {
        helpModal.querySelector('div').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
          helpModal.classList.add('hidden');
        }, 300);
      });
    });

    // Character Counters
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('name-counter');
    const addressInput = document.getElementById('address');
    const addressCounter = document.getElementById('address-counter');

    nameInput.addEventListener('input', () => {
      nameCounter.textContent = nameInput.value.length;
    });

    addressInput.addEventListener('input', () => {
      addressCounter.textContent = addressInput.value.length;
    });

    // Geolocation
    const geolocateBtn = document.getElementById('geolocate-btn');
    geolocateBtn.addEventListener('click', () => {
      if (navigator.geolocation) {
        geolocateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const { latitude, longitude } = position.coords;
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
              .then(response => response.json())
              .then(data => {
                const address = data.display_name || `${data.address?.road}, ${data.address?.city}, ${data.address?.country}`;
                addressInput.value = address;
                addressCounter.textContent = address.length;
                updateProgress();
                geolocateBtn.innerHTML = '<i class="fas fa-location-arrow"></i>';
              })
              .catch(() => {
                alert('Could not retrieve address from coordinates');
                geolocateBtn.innerHTML = '<i class="fas fa-location-arrow"></i>';
              });
          },
          () => {
            alert('Unable to retrieve your location');
            geolocateBtn.innerHTML = '<i class="fas fa-location-arrow"></i>';
          }
        );
      } else {
        alert('Geolocation is not supported by your browser');
      }
    });

    // Currency Selection
    const currencyBtn = document.getElementById('currency-btn');
    const currencySymbol = document.getElementById('currency-symbol');
    const currencies = {
      'USD': '$',
      'EUR': '€',
      'GBP': '£',
      'JPY': '¥',
      'CAD': 'CA$'
    };
    let currentCurrency = 'USD';

    currencyBtn.addEventListener('click', () => {
      const currencyList = Object.keys(currencies);
      const currentIndex = currencyList.indexOf(currentCurrency);
      const nextIndex = (currentIndex + 1) % currencyList.length;
      currentCurrency = currencyList[nextIndex];
      currencySymbol.textContent = currencies[currentCurrency];
      currencyBtn.textContent = `${currentCurrency} ${String.fromCharCode(9660)}`;
      updateSalaryConversion();
    });

    // Salary Conversion
    const salaryInput = document.getElementById('salary');
    const salaryPeriod = document.getElementById('salary-period');
    const salaryConversion = document.getElementById('salary-conversion');

    function updateSalaryConversion() {
      const value = parseFloat(salaryInput.value) || 0;
      const period = salaryPeriod.value;
      
      if (value <= 0) {
        salaryConversion.textContent = '';
        return;
      }

      let hourly, yearly;
      switch (period) {
        case 'hour':
          hourly = value;
          yearly = value * 40 * 52;
          break;
        case 'day':
          hourly = value / 8;
          yearly = value * 5 * 52;
          break;
        case 'week':
          hourly = value / 40;
          yearly = value * 52;
          break;
        case 'month':
          hourly = value / 160;
          yearly = value * 12;
          break;
        case 'year':
          hourly = value / 2080;
          yearly = value;
          break;
      }

      salaryConversion.textContent = `≈ ${currencies[currentCurrency]}${hourly.toFixed(2)}/hour | ${currencies[currentCurrency]}${yearly.toFixed(2)}/year`;
    }

    salaryInput.addEventListener('input', updateSalaryConversion);
    salaryPeriod.addEventListener('change', updateSalaryConversion);

    // Form Progress
    const progressBar = document.getElementById('progress-bar');
    const progressPercentage = document.getElementById('progress-percentage');
    const submitBtn = document.getElementById('submit-btn');

    function updateProgress() {
      const fields = [
        nameInput,
        addressInput,
        salaryInput
      ];
      
      let completed = 0;
      fields.forEach(field => {
        if (field.value.trim() !== '') {
          completed++;
        }
      });
      
      const progress = Math.round((completed / fields.length) * 100);
      progressBar.style.width = `${progress}%`;
      progressPercentage.textContent = `${progress}%`;
      
      submitBtn.disabled = progress < 100;
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
      nameCounter.textContent = nameInput.value.length;
      addressCounter.textContent = addressInput.value.length;
      updateProgress();
      
      // Animate form elements sequentially
      const formElements = document.querySelectorAll('form > div');
      formElements.forEach((el, i) => {
        el.style.animationDelay = `${i * 0.1}s`;
        el.classList.add('animate-fade-in');
      });
    });
  </script>

  <style>
    #theme-toggle:checked + label span {
      transform: translateX(1.25rem);
    }
    
    #help-modal div {
      transition: all 0.3s ease;
    }
    
    .animate-fade-in {
      animation: fadeIn 0.5s ease-in-out forwards;
      opacity: 0;
    }
    
    .animate-pulse-slow {
      animation: pulse-slow 3s infinite;
    }
    
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.5rem center;
      background-size: 1em;
    }
    
    select::-ms-expand {
      display: none;
    }
  </style>
</body>
</html>
