<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question' => 'Will this cabinet suit my UST projector and center channel combination?',
            'answer' => 'Please go to the <a style="color:blue;text-decoration:underline" href="{{ route(\'all_products\') }}">Advanced Search</a> page and provide your case. If you see this cabinet in the output of the search, then yes, this cabinet is compatible with your UST projector and center channel.'
        ]);

        Faq::create([
            'question' => 'Why am I seeing multiple cabinets when I perform a search with my UST projector and center channel?',
            'answer' => 'All cabinets resulting in your search will be compatible with your case. It’s about where you want to place the center channel and where you want your screen. Simulation results in each cabinet section will help you choose the right one for your case.'
        ]);

        Faq::create([
            'question' => 'Is shipping included?',
            'answer' => 'No. Since we get orders from different parts of the world, we have decided to calculate on the go.'
        ]);

        Faq::create([
            'question' => 'Where are you located?',
            'answer' => 'We are located in Mount Juliet 37122 &amp; Cottontown, TN 37048.'
        ]);

        Faq::create([
            'question' => 'Can I save shipping by picking my cabinet from your store location?',
            'answer' => 'Yes, you are free to pick it up from the shop. Please give us a heads-up so that we can be prepared.'
        ]);

        Faq::create([
            'question' => 'How long does it take to produce the cabinets?',
            'answer' => 'It largely depends on the supply chain. For example, if you order a black cabinet liner cabinet, it can be manufactured in a week\'s time. However, if you need Sierra walnut, we need to order from Wilson Art, send it to the cabinet partner for veneering, and then receive the material. It will take 8-10 weeks.'
        ]);

        Faq::create([
            'question' => 'What is the return policy?',
            'answer' => 'We have a 30-day return policy. There will be a restocking fee of 20%, and return shipping is on the customer.'
        ]);

        Faq::create([
            'question' => 'What if I have additional questions?',
            'answer' => 'Please reach out to us with your concerns at <a href="mailto:Praveen.matsa@ustprojectorcabinets.com" style="color:blue;text-decoration:underline">Praveen.matsa@ustprojectorcabinets.com</a>, and we will get back to you as soon as possible.'
        ]);

        Faq::create([
            'question' => 'How strong are these cabinets?',
            'answer' => 'They are made with plywood, and to provide additional strength, we have added heavy-duty L clamps. Customers agree that it is high-quality and sturdy enough to hold heavy equipment.'
        ]);

        Faq::create([
            'question' => 'Why are cabinets low on the ground?',
            'answer' => 'To accommodate UST projectors, we need to ensure the center channel does not interfere with the viewing angle of the spectator. Hence, most cabinets are low-profile.'
        ]);

        Faq::create([
            'question' => 'What if I am not able to decide about the cabinet?',
            'answer' => 'Please refer to the <a style="color:blue;text-decoration:underline" href="{{ route(\'free_quote\') }}">Free Quote</a> section and fill out the form, and we will get back to you.'
        ]);

        Faq::create([
            'question' => 'How many people are required for assembly, and how long does it take?',
            'answer' => 'It depends on the individual, but we recommend 2 people, as there are many parts to fix, which require significant time.'
        ]);

        Faq::create([
            'question' => 'Why did you prefer flat shipping over assembled shipping?',
            'answer' => 'To save on shipping costs.'
        ]);

        Faq::create([
            'question' => 'Are doors IR friendly?',
            'answer' => 'Yes.'
        ]);
    }
}
