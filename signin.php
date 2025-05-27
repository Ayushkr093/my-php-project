<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
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
  <div class="min-h-screen flex">
    <!-- Left Side - Form -->
    <div class="w-full lg:w-1/2 xl:w-2/5 flex items-center justify-center p-8 lg:p-12 xl:p-16">
      <div class="w-full max-w-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
          <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
              <i class="fas fa-sign-in-alt mr-3 text-blue-500"></i>
              Welcome Back
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Sign in to access your account</p>
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
        <form class="space-y-6">
          <!-- Email -->
          <div class="animate-fade-in">
            <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <i class="fas fa-envelope"></i>
              </div>
              <input type="email" id="email" name="email"
                class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500"
                placeholder="your@email.com" required>
            </div>
          </div>

          <!-- Password -->
          <div class="animate-fade-in" style="animation-delay: 0.1s">
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <i class="fas fa-lock"></i>
              </div>
              <input type="password" id="password" name="password"
                class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500"
                placeholder="••••••••" required>
              <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox"
                  class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2">
                <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember me</label>
              </div>
              <div class="text-sm">
                <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">Forgot password?</a>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="animate-fade-in" style="animation-delay: 0.3s">
            <button type="submit"
              class="w-full flex justify-center items-center gap-2 px-4 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition shadow-md">
              <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
          </div>
        </form>

        <!-- Social Login -->
        <div class="animate-fade-in" style="animation-delay: 0.4s">
          <div class="relative mt-8">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Or continue with</span>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-3 gap-3">
            <a href="#" class="flex justify-center items-center py-2 px-4 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
              <i class="fab fa-google text-red-500"></i>
            </a>
            <a href="#" class="flex justify-center items-center py-2 px-4 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
              <i class="fab fa-facebook-f text-blue-600"></i>
            </a>
            <a href="#" class="flex justify-center items-center py-2 px-4 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
              <i class="fab fa-github text-gray-800 dark:text-gray-300"></i>
            </a>
          </div>
        </div>

        <!-- Signup Link -->
        <div class="text-sm text-center text-gray-600 dark:text-gray-400 mt-8">
          Don't have an account? <a href="signup.php" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-medium">Sign up</a>
        </div>
      </div>
    </div>

    <!-- Right Side - Visual -->
    <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 items-center justify-center p-12">
      <div class="max-w-2xl text-center text-white p-8">
        <div class="text-5xl font-bold mb-6">Great to See You Again!</div>
        <p class="text-xl mb-8 opacity-90">Access your personalized dashboard and continue where you left off.</p>
        <div class="flex justify-center space-x-6">
          <div class="text-center">
            <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-2">
              <i class="fas fa-chart-pie text-2xl"></i>
            </div>
            <p class="text-sm font-medium">Analytics</p>
          </div>
          <div class="text-center">
            <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-2">
              <i class="fas fa-cog text-2xl"></i>
            </div>
            <p class="text-sm font-medium">Settings</p>
          </div>
          <div class="text-center">
            <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-2">
              <i class="fas fa-bell text-2xl"></i>
            </div>
            <p class="text-sm font-medium">Notifications</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Theme Script -->
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

    // Password Toggle
    function togglePassword(id) {
      const input = document.getElementById(id);
      const icon = input.nextElementSibling.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>

  <style>
    #theme-toggle:checked + label span {
      transform: translateX(1.25rem);
    }
    
    .animate-fade-in {
      animation: fadeIn 0.5s ease-in-out forwards;
      opacity: 0;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
    
    .dark ::-webkit-scrollbar-track {
      background: #374151;
    }
    
    .dark ::-webkit-scrollbar-thumb {
      background: #6b7280;
    }
    
    .dark ::-webkit-scrollbar-thumb:hover {
      background: #9ca3af;
    }
  </style>
</body>
</html>
