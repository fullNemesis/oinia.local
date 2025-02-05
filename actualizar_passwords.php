<?php
require __DIR__ . '/vendor/autoload.php';

use oinia\core\Security;

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=cursooina',
        'usercurso',
        'php',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    // Actualizar contraseñas
    $usuarios = [
        'usuario' => 'usuario',  // usuario normal con contraseña 'usuario'
        'user' => 'admin',       // admin con contraseña 'admin'
        'nana' => 'nana',        // usuario normal con contraseña 'nana'
        'patata' => 'patata'     // usuario normal con contraseña 'patata'
    ];
    
    $stmt = $pdo->prepare("UPDATE usuarios SET password = :password WHERE username = :username");
    
    foreach ($usuarios as $username => $password) {
        $hashedPassword = Security::encrypt($password);
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword
        ]);
        echo "Actualizada contraseña para usuario: $username\n";
    }
    
    echo "\nContraseñas actualizadas correctamente.\n";
    echo "\nPuedes iniciar sesión con:\n";
    echo "Usuario normal: usuario/usuario\n";
    echo "Administrador: user/admin\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 