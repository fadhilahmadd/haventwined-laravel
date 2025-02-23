<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'title' => 'Tech Innovators Summit 2024',
                'startDate' => '2024-11-15',
                'endDate' => '2024-11-17',
                'location' => 'Jakarta Convention Center',
                'attendees' => 5000,
                'status' => 'open',
                'image' => 'https://imgsrv2.voi.id/DblNhRORCTxc1VJBcSD17d9L91bRxOhUsYp2GNqoCN8/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy80MDcyNjEvMjAyNDA4MTMxMTUwLW1haW4uY3JvcHBlZF8xNzIzNTI0Njc0LnBuZw.jpg'
            ],
            [
                'title' => 'Java Jazz Festival',
                'startDate' => '2024-05-24',
                'endDate' => '2024-05-26',
                'location' => 'JIExpo Kemayoran',
                'attendees' => 15000,
                'status' => 'open',
                'image' => 'https://cdn.rri.co.id/berita/1/images/1703290994557-5/ju6z71cf8r09tla.png'
            ],
            [
                'title' => 'Indonesia International Book Fair',
                'startDate' => '2024-09-05',
                'endDate' => '2024-09-15',
                'location' => 'Istora Senayan',
                'attendees' => 8000,
                'status' => 'open',
                'image' => 'https://w1.indonesia-bookfair.com/uploads/event/1706167844330_IIBF%202024.jpg'
            ],
            [
                'title' => 'Southeast Asian Food Expo',
                'startDate' => '2024-07-12',
                'endDate' => '2024-07-14',
                'location' => 'ICE BSD City',
                'attendees' => 12000,
                'status' => 'open',
                'image' => 'https://www.migrantnews.nz/wp-content/uploads/2023/08/FINAL-VERSION-OF-FLIER-696x696.jpg'
            ],
            [
                'title' => 'Startup Launchpad Competition',
                'startDate' => '2024-08-01',
                'endDate' => '2024-08-03',
                'location' => 'Cyber 2 Tower',
                'attendees' => 2000,
                'status' => 'open',
                'image' => 'https://scontent.fsrg10-1.fna.fbcdn.net/v/t39.30808-6/459580058_924043093090618_8618180008151473014_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_ohc=YqCFH5ux5C8Q7kNvgFA-CUR&_nc_oc=AdgIMjZsirEgJcsnQA0TuwL0ZLE4EPOcXgx4Wcv7wm1GFFeeknNWADGyD6eJhfAaVC0&_nc_zt=23&_nc_ht=scontent.fsrg10-1.fna&_nc_gid=AnxRHnEF5JaNUBfDVUZ2f9T&oh=00_AYD8fBTpXqcq0RHbJYJVSOezE8bb9Lawlu0ypKSPWwYtQA&oe=67C112AC'
            ],
            [
                'title' => 'Jakarta Fashion Week',
                'startDate' => '2024-10-20',
                'endDate' => '2024-10-27',
                'location' => 'Plaza Indonesia',
                'attendees' => 10000,
                'status' => 'open',
                'image' => 'https://www.jakartafashionweek.co.id/img/images/opening%20parade.png'
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}