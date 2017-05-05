<?php
# config/attacher.php

return [
    'model'        => 'Artesaos\Attacher\AttacherModel', # You can customize the model for your needs.
    'base_url'     => config('app.url'), # The url basis for the representation of images.
    'path'         => '/uploads/images/:id/:style/:filename', # Change the path where the images are stored.

    # Where the magic happens.
    # This is where you record what the "styles" that will apply to your image.
    # Each style takes as the parameter is one \Intervention\Image\Image
    # See more in http://image.intervention.io/
    'style_guides' => [
        'default' => [
            'thumb' => function ($image) {
                $image->widen(120);
                return $image;
            }
        ],
        //Avatar
        'avatar' => [
            'normal' => function ($image) {
                $image->fit(150, 150);
                return $image;
            },
            'thumb' => function ($image) {
                $image->fit(60, 60);
                return $image;
            },
        ],
    ],
    'image_quality' => 82
];