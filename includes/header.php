<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Produtos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#64748b',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col font-sans text-gray-800">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-primary flex items-center gap-2">
                <i class="fa-solid fa-box-open"></i> Estoque<span class="text-gray-700">Manager</span>
            </a>
            <div class="hidden md:flex gap-6">
                <a href="index.php" class="text-gray-600 hover:text-primary transition font-medium">Início</a>
                <a href="create.php" class="text-gray-600 hover:text-primary transition font-medium">Novo Produto</a>
            </div>
            <!-- Mobile menu button (simple implementation) -->
            <button class="md:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>
    <main class="flex-grow container mx-auto px-4 py-8 flex flex-col justify-center">