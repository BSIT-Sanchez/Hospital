<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        #next-in-line {
            background-color: #ffeb3b;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.5em;
        }
        .waiting {
            background-color: #ffcc00;
        }
    </style>
</head>
<body>

    <h1>Clinic Queue</h1>

    <div id="next-in-line">Next in Line: <span id="next-patient">Loading...</span></div>

    <h2>Queue List</h2>
    <table id="queue-table">
        <thead>
            <tr>
                <th>Queue Number</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script>
       
        function fetchQueueData() {
            fetch('get_queue.php')
                .then(response => response.json())
                .then(data => {
                   
                    const queueTableBody = document.querySelector('#queue-table tbody');
                    queueTableBody.innerHTML = ''; 

                    data.queueList.forEach(patient => {
                        const row = document.createElement('tr');
                        row.classList.add(patient.status.toLowerCase()); // Add a class for styling based on status
                        row.innerHTML = `
                            <td>${patient.queue_number}</td>
                            <td>${patient.name}</td>
                            <td>${patient.status}</td>
                        `;
                        queueTableBody.appendChild(row);
                    });

                    
                    const nextPatientDiv = document.getElementById('next-patient');
                    if (data.nextInLine) {
                        nextPatientDiv.textContent = `${data.nextInLine.name} (Queue #${data.nextInLine.queue_number})`;
                    } else {
                        nextPatientDiv.textContent = 'No patients in line';
                    }
                })
                .catch(error => console.error('Error fetching queue data:', error));
        }


        setInterval(fetchQueueData, 1000);


        fetchQueueData();
    </script>

</body>
</html>
