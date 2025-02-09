<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">


    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            },

        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="../CSS/output.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>


<style>
    .scroll-none {
        scrollbar-width: none;
    }

    .top {
        z-index: 100;
    }

    .bg-blur {
        backdrop-filter: blur(3px);
        background-color: rgba(0, 0, 0, 0.306);
    }

    /* Dark Mode Switch Background Color */
    .dark .bg-gray-300 {
        background-color: #2563eb !important;
        /* Blue Background for Dark Mode */
    }

    /* Move switch to right when dark mode is active */
    .dark .switch {
        transform: translateX(18px);
        /* Move switch right */
    }

    /* Dark mode switch button colors */
    .dark .peer-checked~div {
        background-color: #2563eb !important;
        /* Dark Mode ON - Blue */
    }
</style>

<body>