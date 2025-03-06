<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation Images</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        .image-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .image-container img {
            width: 100%;
            height: 100vh; /* Full viewport height */
            object-fit: contain; /* Ensures the image is fully visible without cropping */
            border: 1px solid #ddd;
            background: #fff;
        }
    </style>
</head>
<body>
    <h2>Simulation Images</h2>
    <div class="image-container">
        @forelse ($images as $image)
            <img src="{{ asset('uploads/simulation_images/' . $image->image_name) }}" alt="Simulation Image">
        @empty
            <p>No Images Available</p>
        @endforelse
    </div>
</body>
</html>
