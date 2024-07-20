<!DOCTYPE html>
<html>
<head>
    <title>Revisions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f0f0f0;
        }
        .detail-link {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .close-modal {
            float: right;
            cursor: pointer;
            color: #aaa;
        }
        .close-modal:hover {
            color: #000;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Revisions</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Model ID</th>
                <th>User ID / Name</th>
                <th>Field</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Changed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revisions as $revision)
                @php 
                    $userWhich = $revision->user_id == auth()->user()->id ? auth()->user()->name : 'n/a';
                @endphp
                <tr>
                    <td>{{ $revision->id }}</td>
                    <td>{{ class_basename($revision->revisionable_type) }}</td>
                    <td>{{ $revision->revisionable_id }}</td>
                    <td>Id: {{ $revision->user_id }} / {{ $userWhich }}</td>
                    <td>{{ $revision->key }}</td>
                    <td>{{ $revision->old_value }}</td>
                    <td>{{ $revision->new_value }}</td>
                    <td>{{ $revision->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Deleted Data</h2>
    @if ($deletedClients->isNotEmpty())
        <table>
            <thead>
                <tr>
                    @foreach ($deletedClients->first()->getAttributes() as $key => $value)
                        <th>{{ $key }}</th>
                    @endforeach
                    <th>Deleted At</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedClients as $client)
                    <tr>
                        @foreach ($client->getAttributes() as $key => $value)
                            <td>{{ $value }}</td>
                        @endforeach
                        <td>{{ $client->deleted_at }}</td>
                        <td><span class="detail-link" onclick="showDetails({{ $client->id }})">Details</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No deleted clients found.</p>
    @endif
</div>

<div id="detailsModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <h2>Client Details</h2>
        <div id="modalContent"></div>
    </div>
</div>

<script>
    function showDetails(clientId) {
        // Fetch details from the server (you'll need to implement this part in Laravel)
        fetch(`/client-details/${clientId}`)
            .then(response => response.json())
            .then(data => {
                let modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                    <h3>Branches</h3>
                    ${data.branches.map(branch => `<p>${branch.name}</p>`).join('')}
                    <h3>Addresses</h3>
                    ${data.addresses.map(address => `<p>${address.street}</p>`).join('')}
                    <h3>Companies</h3>
                    ${data.companies.map(company => `<p>${company.name}</p>`).join('')}
                    <h3>Payments</h3>
                    ${data.payments.map(payment => `<p>${payment.amount}</p>`).join('')}
                `;
                document.getElementById('detailsModal').style.display = 'flex';
            })
            .catch(error => console.error('Error:', error));
    }

    function closeModal() {
        document.getElementById('detailsModal').style.display = 'none';
    }
</script>
</body>
</html>
