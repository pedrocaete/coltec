<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
    session_start();
    
    // Initialize the variable if not already set
    if (!isset($_SESSION['counter'])) {
        $_SESSION['counter'] = 0;
    }
    
    // If this is an AJAX request to increment
    if (isset($_POST['action']) && $_POST['action'] == 'increment') {
        $_SESSION['counter']++;
        echo $_SESSION['counter'];
        exit;
    }
    ?>
    
    <h2>Counter: <span id="counter"><?php echo $_SESSION['counter']; ?></span></h2>
    <button id="incrementBtn">Increment</button>

    <script>
    $(document).ready(function() {
        $('#incrementBtn').click(function() {
            $.ajax({
                type: 'POST',
                url: '',
                data: { action: 'increment' },
                success: function(response) {
                    $('#counter').text(response);
                }
            });
        });
    });
    </script>
</body>
</html>