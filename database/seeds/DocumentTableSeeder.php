<?php

use Illuminate\Database\Seeder;
use App\Model\Document;
class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $document = [
           [
            'name' => 'Registration Certificate'
           ],

           [
           	'name' => 'Tax Clearance Certificate'
           ]       
        ];
        foreach ($document as $key => $value) {
			     Document::create($value);
		    }
    }
}
