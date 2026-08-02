<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport mensuel</title>

    <style>
        body{
            font-family: DejaVu Sans,sans-serif;
            color:#1f2937;
            font-size:13px;
        }

        h1{
            margin-bottom:0;
            font-size:28px;
        }

        h2{
            margin-top:35px;
            margin-bottom:10px;
            border-bottom:1px solid #d1d5db;
            padding-bottom:6px;
        }

        .subtitle{
            color:#6b7280;
            margin-bottom:25px;
        }

        .stats{
            width:100%;
            margin-bottom:30px;
        }

        .card{
            width:31%;
            display:inline-block;
            border:1px solid #d1d5db;
            padding:15px;
            text-align:center;
            box-sizing:border-box;
        }

        .card h3{
            margin:0;
            font-size:32px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th{
            background:#f3f4f6;
        }

        th,td{
            border:1px solid #d1d5db;
            padding:8px;
            text-align:left;
        }

        .footer{
            margin-top:40px;
            text-align:center;
            color:#6b7280;
            font-size:11px;
        }
    </style>
</head>

<body>

<h1>Rapport mensuel</h1>

<p class="subtitle">
    {{ ucfirst($month->translatedFormat('F Y')) }}
</p>

<div class="stats">

    <div class="card">
        <h3>{{ $animalsInShelterCount }}</h3>
        <p>Animaux encore au refuge</p>
    </div>

    <div class="card">
        <h3>{{ $animalsWelcomedCount }}</h3>
        <p>Animaux accueillis</p>
    </div>

    <div class="card">
        <h3>{{ $adoptionsCount }}</h3>
        <p>Demandes d'adoption</p>
    </div>

</div>

<h2>Animaux accueillis ce mois-ci</h2>

<table>

    <thead>
    <tr>
        <th>Nom</th>
        <th>Espèce</th>
        <th>Race</th>
        <th>Sexe</th>
        <th>Date</th>
        <th>Statut</th>
    </tr>
    </thead>

    <tbody>

    @forelse($animals as $animal)

        <tr>
            <td>{{ $animal->name }}</td>
            <td>{{ $animal->species }}</td>
            <td>{{ $animal->breed?->name }}</td>
            <td>{{ $animal->sex }}</td>
            <td>{{ $animal->created_at?->format('d/m/Y') }}</td>
            <td>{{ $animal->status }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="6">
                Aucun animal accueilli durant cette période.
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<h2>Demandes d'adoption</h2>

<table>

    <thead>
    <tr>
        <th>Adoptant</th>
        <th>Animal</th>
        <th>Date</th>
    </tr>
    </thead>

    <tbody>

    @forelse($adoptions as $adoption)

        <tr>
            <td>{{ $adoption->firstName }} {{ $adoption->lastName }}</td>
            <td>{{ $adoption->animal?->name }}</td>
            <td>{{ $adoption->created_at?->format('d/m/Y') }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="3">
                Aucune demande d'adoption durant cette période.
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<div class="footer">
    Rapport généré le {{ now()->format('d/m/Y à H:i') }}
</div>

</body>
</html>
