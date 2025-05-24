<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestingXperts - Employee Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import "https://unpkg.com/open-props/easings.min.css";

        /* Dark mode toggle styles */
        .sun-and-moon > :is(.moon, .sun, .sun-beams) {
          transform-origin: center;
        }

        .sun-and-moon > :is(.moon, .sun) {
          fill: var(--icon-fill);
        }

        .theme-toggle:is(:hover, :focus-visible) > .sun-and-moon > :is(.moon, .sun) {
          fill: var(--icon-fill-hover);
        }

        .sun-and-moon > .sun-beams {
          stroke: var(--icon-fill);
          stroke-width: 2px;
        }

        .theme-toggle:is(:hover, :focus-visible) .sun-and-moon > .sun-beams {
          stroke: var(--icon-fill-hover);
        }

        [data-theme="dark"] .sun-and-moon > .sun {
          transform: scale(1.75);
        }

        [data-theme="dark"] .sun-and-moon > .sun-beams {
          opacity: 0;
        }

        [data-theme="dark"] .sun-and-moon > .moon > circle {
          transform: translateX(-7px);
        }

        @supports (cx: 1) {
          [data-theme="dark"] .sun-and-moon > .moon > circle {
            cx: 17;
            transform: translateX(0);
          }
        }

        @media (prefers-reduced-motion: no-preference) {
          .sun-and-moon > .sun {
            transition: transform .5s var(--ease-elastic-3);
          }

          .sun-and-moon > .sun-beams {
            transition: transform .5s var(--ease-elastic-4), opacity .5s var(--ease-3);
          }

          .sun-and-moon .moon > circle {
            transition: transform .25s var(--ease-out-5);
          }

          @supports (cx: 1) {
            .sun-and-moon .moon > circle {
              transition: cx .25s var(--ease-out-5);
            }
          }

          [data-theme="dark"] .sun-and-moon > .sun {
            transition-timing-function: var(--ease-3);
            transition-duration: .25s;
            transform: scale(1.75);
          }

          [data-theme="dark"] .sun-and-moon > .sun-beams {
            transition-duration: .15s;
            transform: rotateZ(-25deg);
          }

          [data-theme="dark"] .sun-and-moon > .moon > circle {
            transition-duration: .5s;
            transition-delay: .25s;
          }
        }

        :root {
          --icon-fill: hsl(210, 100%, 30%);
          --icon-fill-hover: hsl(210, 100%, 20%);
        }

        [data-theme="dark"] {
          --icon-fill: hsl(210, 100%, 80%);
          --icon-fill-hover: hsl(210, 100%, 90%);
        }

        /* Table Styling */
        .masthead {
            background-color: #1e40af;
            padding: 2rem 0;
        }

        .wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }

        .light .table {
            background-color: rgba(255, 255, 255, 0.9);
            color: #212529;
        }

        .dark .table {
            background-color: rgba(31, 41, 55, 0.9);
            color: #f3f4f6;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid;
        }

        .light .table th,
        .light .table td {
            border-top-color: rgba(0, 0, 0, 0.1);
        }

        .dark .table th,
        .dark .table td {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid;
        }

        .light .table thead th {
            border-bottom-color: rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dark .table thead th {
            border-bottom-color: rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.2);
        }

        .table-bordered {
            border: 1px solid;
        }

        .light .table-bordered {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .dark .table-bordered {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid;
        }

        .light .table-bordered th,
        .light .table-bordered td {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .dark .table-bordered th,
        .dark .table-bordered td {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .light .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dark .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: all 0.15s ease-in-out;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .pull-left {
            float: left;
        }

        .pull-right {
            float: right;
        }

        .text-center {
            text-align: center;
        }

        .text-white {
            color: #fff !important;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .dark .alert-danger {
            color: #f8d7da;
            background-color: #721c24;
            border-color: #842029;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#1e40af',
                        'brand-light': '#3b82f6',
                        'brand-dark': '#0f2a5c',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
  
<!-- Notification bar -->
    <div id="notification-bar" class="bg-brand-blue text-white text-center py-2 px-4 text-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <span>🚀 Special offer: Get 20% off on all testing services this month!</span>
            <button id="close-notification" class="ml-4 hover:opacity-80 transition-opacity">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <nav class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300 sticky top-0 z-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button type="button" id="mobile-menu-button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-200" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Close icon -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex flex-shrink-0 items-center">
                    <a href="https://www.testingxperts.com/" class="flex items-center group">
                        <img class="h-10 w-auto transition-transform duration-300 group-hover:scale-105" src="https://via.placeholder.com/180x70/1e40af/ffffff?text=TestingXperts" alt="TestingXperts">
                        <span class="ml-2 text-xl font-bold text-brand-blue dark:text-blue-400 hidden md:inline">TestingXperts</span>
                    </a>
                </div>

                <!-- Desktop Navigation - Centered -->
                <div class="hidden sm:flex items-center justify-center flex-1 mx-8">
                    <div class="flex space-x-1">
                        <a href="#solutions" class="relative group px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-blue dark:hover:text-blue-400 transition-colors duration-200">
                            Solutions
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-brand-blue dark:bg-blue-400 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                        </a>
                        <a href="#services" class="relative group px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-blue dark:hover:text-blue-400 transition-colors duration-200">
                            Services
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-brand-blue dark:bg-blue-400 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                        </a>
                        <div class="dropdown-container relative group" onmouseenter="showDropdown('industries-dropdown')" onmouseleave="hideDropdown('industries-dropdown')">
                            <button class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-blue dark:hover:text-blue-400 transition-colors duration-200">
                                Industries
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="industries-dropdown" class="dropdown-menu hidden absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none p-2 z-50">
                                <a href="#healthcare" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Healthcare</a>
                                <a href="#finance" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Finance</a>
                                <a href="#retail" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Retail</a>
                                <a href="#technology" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Technology</a>
                                <a href="#education" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Education</a>
                                <a href="#manufacturing" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Manufacturing</a>
                            </div>
                        </div>
                        <a href="#resources" class="relative group px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-blue dark:hover:text-blue-400 transition-colors duration-200">
                            Resources
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-brand-blue dark:bg-blue-400 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                        </a>
                        <a href="#about" class="relative group px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-blue dark:hover:text-blue-400 transition-colors duration-200">
                            About Us
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-brand-blue dark:bg-blue-400 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                        </a>
                    </div>
                </div>

                <!-- Right side actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search button -->
                    <button class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition-colors duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    <!-- Dark mode toggle -->
                    <button class="theme-toggle p-2" id="theme-toggle" title="Toggles light & dark" aria-label="auto" aria-live="polite">
                      <svg class="sun-and-moon" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                        <mask class="moon" id="moon-mask">
                          <rect x="0" y="0" width="100%" height="100%" fill="white" />
                          <circle cx="24" cy="10" r="6" fill="black" />
                        </mask>
                        <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon-mask)" fill="currentColor" />
                        <g class="sun-beams" stroke="currentColor">
                          <line x1="12" y1="1" x2="12" y2="3" />
                          <line x1="12" y1="21" x2="12" y2="23" />
                          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                          <line x1="1" y1="12" x2="3" y2="12" />
                          <line x1="21" y1="12" x2="23" y2="12" />
                          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                         </g>
                      </svg>
                    </button>

                    <!-- Contact button -->
                    <a href="#contact" class="hidden md:inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-brand-blue dark:text-blue-400 bg-blue-50 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-phone-alt mr-2"></i> Contact
                    </a>

                    <!-- Sign Up button -->
                    <a href="#signup" class="hidden md:inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-brand-blue to-brand-dark dark:from-blue-600 dark:to-blue-800 hover:from-brand-dark hover:to-brand-blue dark:hover:from-blue-700 dark:hover:to-blue-600 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <a href="#solutions" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Solutions</a>
                <a href="#services" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Services</a>
                <div class="pl-3">
                    <button class="flex items-center w-full py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white" id="mobile-industries-button">
                        Industries
                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="hidden pl-4 mt-1" id="mobile-industries-menu">
                        <a href="#healthcare" class="block py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Healthcare</a>
                        <a href="#finance" class="block py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Finance</a>
                        <a href="#retail" class="block py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Retail</a>
                    </div>
                </div>
                <a href="#resources" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Resources</a>
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">About Us</a>
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-brand-blue dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700">Contact Us</a>
                    <a href="#signup" class="mt-2 block w-full text-center px-3 py-2 rounded-md text-base font-medium text-white bg-brand-blue dark:bg-blue-600 hover:bg-brand-dark dark:hover:bg-blue-700">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>


<!-- Employee Table Content -->
    <header class="masthead">
     <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    
                    <!-- Title & Stats -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Employee Management</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Manage your team members and their information</p>
                        
                        <!-- Stats Row -->
                        <?php
                        require_once "config.php";
                        $count_sql = "SELECT COUNT(*) as total FROM employees";
                        $count_result = mysqli_query($link, $count_sql);
                        $total_employees = mysqli_fetch_array($count_result)['total'];
                        ?>
                        <div class="flex items-center gap-6 mt-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Total Employees: <span class="font-semibold text-gray-900 dark:text-white"><?php echo $total_employees; ?></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Active Records</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <button class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export
                        </button>
                        
                        <a href="create.php" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg text-sm font-medium shadow-sm hover:shadow-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Employee
                        </a>
                    </div>
                </div>
            </div>

            <?php
            // Attempt select query execution
            $sql = "SELECT * FROM employees ORDER BY id DESC";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
            ?>
            
            <!-- Advanced Table Container -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Employee Directory</h3>
                        <div class="flex items-center gap-3">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" placeholder="Search employees..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Filter -->
                            <button class="inline-flex items-center gap-2 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                                </svg>
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/25">
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <div class="flex items-center justify-center gap-1">
                                        ID
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <div class="flex items-center justify-center gap-1">
                                        Name
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <div class="flex items-center justify-center gap-1">
                                        Address
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <div class="flex items-center justify-center gap-1">
                                        Salary
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150 group">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-full text-sm font-medium">
                                            <?php echo htmlspecialchars($row['id']); ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                <?php echo strtoupper(substr(htmlspecialchars($row['name']), 0, 2)); ?>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    <?php echo htmlspecialchars($row['name']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs truncate">
                                        <?php echo htmlspecialchars($row['address']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        $<?php echo number_format($row['salary']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Action -->
                                        <a href="read.php?id=<?php echo $row['id']; ?>" 
                                           class="inline-flex items-center justify-center w-9 h-9 text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200 group" 
                                           title="View Employee">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        
                                        <!-- Edit Action -->
                                        <a href="update.php?id=<?php echo $row['id']; ?>" 
                                           class="inline-flex items-center justify-center w-9 h-9 text-gray-400 hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg transition-all duration-200" 
                                           title="Edit Employee">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        
                                        <!-- Delete Action -->
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" 
                                           class="inline-flex items-center justify-center w-9 h-9 text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all duration-200" 
                                           title="Delete Employee"
                                           onclick="return confirm('Are you sure you want to delete this employee?');">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Table Footer -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing <?php echo mysqli_num_rows($result); ?> of <?php echo $total_employees; ?> employees
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 disabled:opacity-50">Previous</button>
                            <div class="flex items-center gap-1">
                                <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">1</button>
                                <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">2</button>
                                <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">3</button>
                            </div>
                            <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
                // Free result set
                mysqli_free_result($result);
            } else {
                echo '<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No employees found</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Get started by adding your first employee to the system.</p>
                        <a href="create.php" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Employee
                        </a>
                      </div>';
            }
        } else {
            echo '<div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl p-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                        </svg>
                        <span class="text-red-800 dark:text-red-200 font-medium">Database connection error. Please try again later.</span>
                    </div>
                  </div>';
        } 
        // Close connection
        mysqli_close($link);
        ?>
        </div>
    </div>
</header>

    <script>
        // Dark mode functionality
        const storageKey = 'theme-preference'

        const onClick = () => {
          // flip current value
          theme.value = theme.value === 'light'
            ? 'dark'
            : 'light'

          setPreference()
        }

        const getColorPreference = () => {
          if (localStorage.getItem(storageKey))
            return localStorage.getItem(storageKey)
          else
            return window.matchMedia('(prefers-color-scheme: dark)').matches
              ? 'dark'
              : 'light'
        }

        const setPreference = () => {
          localStorage.setItem(storageKey, theme.value)
          reflectPreference()
        }

        const reflectPreference = () => {
          document.firstElementChild
            .setAttribute('data-theme', theme.value)

          document
            .querySelector('#theme-toggle')
            ?.setAttribute('aria-label', theme.value)
            
          // Also set the class for Tailwind dark mode
          if (theme.value === 'dark') {
            document.documentElement.classList.add('dark')
            document.documentElement.classList.remove('light')
          } else {
            document.documentElement.classList.add('light')
            document.documentElement.classList.remove('dark')
          }
        }

        const theme = {
          value: getColorPreference(),
        }

        // set early so no page flashes / CSS is made aware
        reflectPreference()

        window.onload = () => {
          // set on load so screen readers can see latest value on the button
          reflectPreference()

          // now this script can find and listen for clicks on the control
          document
            .querySelector('#theme-toggle')
            .addEventListener('click', onClick)
        }

        // sync with system changes
        window
          .matchMedia('(prefers-color-scheme: dark)')
          .addEventListener('change', ({matches:isDark}) => {
            theme.value = isDark ? 'dark' : 'light'
            setPreference()
          })

        // Notification bar close functionality
        document.getElementById('close-notification')?.addEventListener('click', () => {
            document.getElementById('notification-bar').style.display = 'none';
        });
    </script>
</body>
</html>