<!DOCTYPE html>
<html>
<head>
@vite('resources/css/app.css') {{-- Initialize TailwindCSS --}}
</head>
<body>
  <div class="py-12">
  <div class="max-w-2xl mx-auto">
    <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 border-b border-gray-200">
        {{$slot}} {{-- to be substituted by other blade.php files --}}
      </div>
    </div>
  </div>
</body>
</html>