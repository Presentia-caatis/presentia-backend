<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\SchoolFeature;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolFeatureUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_school()
    {
        $schoolFeature = SchoolFeature::factory()->create();

        $this->assertNotNull($schoolFeature->school);
    }

    /** @test */
    public function it_belongs_to_feature()
    {
        $schoolFeature = SchoolFeature::factory()->create();

        $this->assertNotNull($schoolFeature->feature);
    }
}
