<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Form con pestañas</title>
</head>
<body>
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form method="POST" action="process.php" id="form1">
                    <input type="text" name="campo1" placeholder="Campo 1">
                    <button type="submit">Enviar</button>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form method="POST" action="process.php" id="form2">
                    <input type="text" name="campo2" placeholder="Campo 2">
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Guardar la pestaña activa antes de enviar el formulario
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                localStorage.setItem('activeTab', event.target.id);
            });
        });

        // Restaurar la pestaña activa al recargar la página
        document.addEventListener('DOMContentLoaded', () => {
            const activeTabId = localStorage.getItem('activeTab');
            if (activeTabId) {
                const activeTab = document.getElementById(activeTabId);
                const tab = new bootstrap.Tab(activeTab);
                tab.show();
            }
        });
    </script>
</body>
</html>