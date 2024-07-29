<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaders Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }
        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .card-container {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Leaders Information</h2>

        <div class="card-container" id="card-container">
            <!-- Cards will be injected here by JavaScript -->
        </div>
    </div>

    <script>
        async function fetchLeaders() {
            try {
                const response = await fetch('./../controller/fetchleaders.php'); // Ensure the path is correct
                const leaders = await response.json();
                console.log(leaders);
                const cardContainer = document.getElementById('card-container');
                
                if (leaders.length > 0) {
                    leaders.forEach(leader => {
                        const card = document.createElement('div');
                        card.className = 'card';
                        card.innerHTML = `
                            <img src="${leader.photo}" class="card-img-top" alt="Leader Photo">
                            <div class="card-body">
                                <h5 class="card-title">${leader.leadername}</h5>
                                <p class="card-text">${leader.role}</p>
                                                           </div>
                        `;
                        cardContainer.appendChild(card);
                    });
                } else {
                    cardContainer.innerHTML = "<p>No leaders found.</p>";
                }
            } catch (error) {
                console.error('Error fetching leaders:', error);
                document.getElementById('card-container').innerHTML = "<p>Error fetching leaders.</p>";
            }
        }

        function viewDetails(id, name, role) {
            Swal.fire({
                title: 'Leader Details',
                html: `
                    <b>ID:</b> ${id}<br>
                    <b>Name:</b> ${name}<br>
                    <b>Role:</b> ${role}<br>
                `,
                confirmButtonText: 'Close',
                customClass: {
                    container: 'text-left'
                }
            });
        }

        // Fetch leaders data when the page loads
        window.onload = fetchLeaders;
    </script>
</body>
</html>
