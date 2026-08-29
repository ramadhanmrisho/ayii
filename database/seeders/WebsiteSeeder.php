<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Solution;
use App\Models\Statistic;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WebsiteSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['general', 'company_name', 'Ayii'],
            ['general', 'tagline', 'Your Partner of Choice'],
            ['general', 'industry', 'Sales & Supply of All Electronics'],
            ['general', 'currency', 'TZS'],
            ['general', 'timezone', 'Africa/Dar_es_Salaam'],
            ['contact', 'contact_person', 'Elias Mushi'],
            ['contact', 'position', 'Co-Founder & Managing Director'],
            ['contact', 'phone', '+255 758 867 012'],
            ['contact', 'whatsapp', '+255 758 867 012'],
            ['contact', 'email', 'elias@ayii.co.tz'],
            ['contact', 'website', 'www.ayii.co.tz'],
            ['contact', 'address', "New Bagamoyo Road, Morocco\nUporoto Street, Ursino Estate\nPlot No. 12, Block E\nDar es Salaam, Tanzania"],
            ['seo', 'default_title', 'Ayii - Sales & Supply of All Electronics'],
            ['seo', 'default_meta_description', 'Ayii supplies reliable electronics, ICT equipment, appliances, generators and assistive technologies for homes, businesses and institutions.'],
            ['homepage', 'hero_eyebrow', 'WELCOME TO AYII'],
            ['homepage', 'hero_heading', 'Smarter Technology. Better Solutions.'],
            ['homepage', 'hero_highlight', 'Stronger Tomorrow.'],
            ['homepage', 'hero_description', 'We supply high-quality electronics, ICT equipment and innovative technologies that power homes, businesses and institutions across Tanzania.'],
            ['homepage', 'hero_primary_cta_text', 'EXPLORE PRODUCTS'],
            ['homepage', 'hero_primary_cta_url', '/products'],
            ['homepage', 'hero_secondary_cta_text', 'REQUEST A QUOTE'],
            ['homepage', 'hero_secondary_cta_url', '/quote'],
            ['homepage', 'hero_active', true, 'boolean'],
        ];

        foreach ($settings as $setting) {
            [$group, $key, $value] = $setting;

            Setting::updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $value, 'type' => $setting[3] ?? 'string']
            );
        }

        collect([
            'Consumer Electronics', 'Home Appliances', 'Kitchen Appliances', 'Commercial Appliances',
            'ICT & Computing', 'Networking & Communication', 'Power & Generators',
            'Assistive Technology', 'Office & Institutional Equipment',
        ])->each(fn (string $name, int $index) => Category::updateOrCreate(
            ['slug' => Str::slug($name)],
            [
                'name' => $name,
                'description' => "Ayii supplies dependable {$name} for homes, businesses and institutions.",
                'sort_order' => $index + 1,
                'featured' => true,
                'active' => true,
            ]
        ));

        collect([
            'Corporate ICT Solutions',
            'Education Solutions',
            'Hospitality Solutions',
            'Government & Institutional Supply',
            'Power Solutions',
            'Assistive Technology',
        ])->each(fn (string $title, int $index) => Solution::updateOrCreate(
            ['slug' => Str::slug($title)],
            [
                'title' => $title,
                'short_description' => "Reliable {$title} tailored for operational needs.",
                'description' => "Ayii supports clients with sourcing, supply and support for {$title}.",
                'display_order' => $index + 1,
                'featured' => true,
                'active' => true,
            ]
        ));

        TeamMember::updateOrCreate(
            ['email' => 'elias@ayii.co.tz'],
            ['name' => 'Elias Mushi', 'position' => 'Co-Founder & Managing Director', 'active' => true]
        );

        collect([
            ['1000', '+', 'Products'],
            ['500', '+', 'Happy Clients'],
            ['24/7', '', 'Support'],
            ['100', '%', 'Satisfaction'],
        ])->each(fn (array $stat, int $index) => Statistic::updateOrCreate(
            ['label' => $stat[2]],
            ['value' => $stat[0], 'suffix' => $stat[1], 'sort_order' => $index + 1, 'active' => true]
        ));
    }
}
