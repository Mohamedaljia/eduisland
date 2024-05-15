<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
</head>
<body>
    <main class="content">
        <div class="container p-0">
            <h1 class="h3 mb-3">Messages</h1>
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right">
                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                <form id="selectForm" method="post" action="fetch_initial_message.php">
                                <select class="form-control my-3" id="userSelect" name="name">
                                        <?php
                                        // Connect to the database
                                        $con = new mysqli('localhost', 'root', 'Rubyboubi2020', 'projectdba');
                                        if (!$con) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        // Fetch all id_student values from the chat table
                                        $sql = "SELECT name FROM chat";
                                        $result = mysqli_query($con, $sql);
                                        if (!$result) {
                                            die("Query failed: " . mysqli_error($con));
                                        }

                                        // Loop through the results and create options for the select input
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                           
                                        }

                                        // Close the database connection
                                        mysqli_close($con);
                                        ?>
                                    </select>
                              
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong id="selectedUser">user</strong>
                                    <div class="text-muted small"><em>Typing...</em></div>
                                </div>
                                <div>
                                    <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative">
                            <div class="chat-messages p-4" id="chatMessages">
                                
                                <?php
                                // Connect to the database
                                $con = new mysqli('localhost', 'root', 'Rubyboubi2020', 'projectdba');
                                if (!$con) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = "SELECT message FROM chat WHERE name='lina' LIMIT 1";
                                $result = mysqli_query($con, $sql);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    // Display the initial message
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['message'];
                                } else {
                                    echo "No initial message found";
                                }

                                // Close the database connection
                                mysqli_close($con);
                                ?>
                            </div>
                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="messageInput" placeholder="Type your message">
                                    <button class="btn btn-primary" id="sendMessageButton">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // Update the selected user name when the select input changes
        $(document).ready(function() {
            $('#userSelect').change(function() {
                var selectedUserName = $(this).val();
                $('#selectedUser').text(selectedUserName);
            });

            // Send message functionality
            $('#sendMessageButton').click(function() {
                var message = $('#messageInput').val();
                $('#chatMessages').append('<div class="chat-message-right pb-4"><div><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="You" width="40" height="40"><div class="text-muted small text-nowrap mt-2">2:33 am</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div>' + message + '</div></div>');
                $('#messageInput').val('');
            });
        });
    </script>
    <script>
    // Get the <select> element
    var selectElement = document.getElementById('userSelect');

    // Add event listener to listen for changes in selection
    selectElement.addEventListener('change', function() {
        // Get the selected value
        var selectedValue = selectElement.value;

        // Store the selected value in a variable called disp
        var disp = selectedValue;

        // Display the selected value (you can replace console.log with any other action you want)
        console.log('Selected value:', disp);
    });
</script>
</body>
</html>