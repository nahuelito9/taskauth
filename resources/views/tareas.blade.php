<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskAuth - Mis Tareas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; justify-content: center; padding: 40px 20px; }
        .container { background: white; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 40px; width: 100%; max-width: 600px; }
        h1 { color: #333; margin-bottom: 8px; text-align: center; }
        .saludo { text-align: center; color: #888; margin-bottom: 24px; font-size: 14px; }
        form.crear { display: flex; gap: 8px; margin-bottom: 24px; }
        input[type="text"] { flex: 1; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; }
        input[type="text"]:focus { outline: none; border-color: #667eea; }
        .btn-add { background: #667eea; color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        ul { list-style: none; }
        li { display: flex; align-items: center; justify-content: space-between; padding: 16px; background: #f7f8fc; border-radius: 10px; margin-bottom: 12px; }
        li.completada { background: #e8f5e9; }
        .titulo { font-size: 16px; color: #333; }
        .titulo.tachado { text-decoration: line-through; color: #999; }
        .acciones { display: flex; gap: 8px; }
        button { border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: bold; }
        .btn-completar { background: #4caf50; color: white; }
        .btn-borrar { background: #f44336; color: white; }
        .logout { display: block; text-align: center; margin-top: 20px; }
        .logout button { background: #eee; color: #666; padding: 8px 16px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mis Tareas 📝</h1>
        <p class="saludo">Hola, {{ auth()->user()->name }} 👋</p>

        <form class="crear" action="/tareas" method="POST">
            @csrf
            <input type="text" name="title" placeholder="¿Qué necesitas hacer?" required>
            <button type="submit" class="btn-add">➕ Agregar</button>
        </form>

        <ul>
            @foreach ($tareas as $tarea)
                <li class="{{ $tarea->completed ? 'completada' : '' }}">
                    <span class="titulo {{ $tarea->completed ? 'tachado' : '' }}">
                        {{ $tarea->completed ? '✅' : '' }} {{ $tarea->title }}
                    </span>
                    <div class="acciones">
                        @if (!$tarea->completed)
                            <form action="/tareas/{{ $tarea->id }}/completar" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-completar">Completar</button>
                            </form>
                        @endif
                        <form action="/tareas/{{ $tarea->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-borrar">🗑️</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="logout">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </div>
</body>
</html>