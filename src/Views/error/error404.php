<style>
    .error404 {
        text-align: center;
        padding: 40px 20px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        max-width: 600px;
        margin: 50px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .error404 h3 {
        font-size: 24px;
        color: #dc3545;
        margin-bottom: 20px;
    }

    .error404 p {
        font-size: 18px;
        color: #495057;
        margin-bottom: 20px;
    }

    .error404 a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        border: 1px solid #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .error404 a:hover {
        background-color: #0056b3;
        color: white;
    }

</style>
<div class="error404">
    <hr>
    <h3><?= htmlspecialchars($titulo); ?></h3>
    <p>Tal vez quieras volver al inicio</p>
    <a href="<?= BASE_URL ?>">Volver</a>
</div>
