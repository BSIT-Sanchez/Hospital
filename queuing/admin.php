<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        select {
            padding: 5px;
            margin: 5px;
        }
        .waiting {
            background-color: #ffcc00;
        }
        .completed {
            background-color: #90ee90;
        }
    </style>
</head>
<body>

    <h1>Update Patient Status</h1>

    <h2>Queue List</h2>
    <table id="queue-list">
        <thead>
            <tr>
                <th>Queue Number</th>
                <th>Name</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>

    <h2>Completed List</h2>
    <table id="completed-list">
        <thead>
            <tr>
                <th>Queue Number</th>
                <th>Name</th>
                <th>Status</th>
                <th>Move Back to Queue</th>
            </tr>
        </thead>
        <tbody>
            <!-- Completed list rows will be populated here -->
        </tbody>
    </table>

    <script>
       
        function fetchPatientLists() {
            fetch('get_queue.php')
                .then(response => response.json())
                .then(data => {
                    const queueTableBody = document.querySelector('#queue-list tbody');
                    const completedTableBody = document.querySelector('#completed-list tbody');

                   
                    queueTableBody.innerHTML = '';
                    completedTableBody.innerHTML = '';

                    
                    data.queueList.forEach(patient => {
                        const row = document.createElement('tr');
                        row.classList.add(patient.status.toLowerCase());
                        row.innerHTML = `
                            <td>${patient.queue_number}</td>
                            <td>${patient.name}</td>
                            <td>${patient.status}</td>
                            <td>
                                <select onchange="updateStatus(${patient.id}, this.value)">
                                    <option value="Waiting" ${patient.status === 'Waiting' ? 'selected' : ''}>Waiting</option>
                                    <option value="Consulting" ${patient.status === 'Consulting' ? 'selected' : ''}>Consulting</option>
                                    <option value="Completed" ${patient.status === 'Completed' ? 'selected' : ''}>Completed</option>
                                    <option value="Cancelled" ${patient.status === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
                                </select>
                            </td>
                        `;
                        queueTableBody.appendChild(row);
                    });

                   
                    data.completedList.forEach(patient => {
                        const row = document.createElement('tr');
                        row.classList.add(patient.status.toLowerCase());
                        row.innerHTML = `
                            <td>${patient.queue_number}</td>
                            <td>${patient.name}</td>
                            <td>${patient.status}</td>
                            <td>
                                <button onclick="moveToQueue(${patient.id})">Move Back to Queue</button>
                            </td>
                        `;
                        completedTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching patient lists:', error));
        }

   
        function updateStatus(patientId, status) {
            const formData = new FormData();
            formData.append('action', 'updateStatus');
            formData.append('patientId', patientId);
            formData.append('newStatus', status);

            fetch('update_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    fetchPatientLists();  
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error updating status:', error));
        }

       
        function moveToQueue(patientId) {
            const formData = new FormData();
            formData.append('action', 'moveToQueue');
            formData.append('patientId', patientId);

            fetch('update_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    fetchPatientLists();  
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error moving patient back to queue:', error));
        }

        
        fetchPatientLists();

        
        setInterval(fetchPatientLists, 5000);
    </script>

</body>
</html>
