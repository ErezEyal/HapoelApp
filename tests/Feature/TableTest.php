<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{

    /** @test */
    public function table_contains_correct_data()
    {
        $response = $this->get('/table');
        $response->assertStatus(200)->assertSee("Hapoel Tel Aviv");
    }
}
