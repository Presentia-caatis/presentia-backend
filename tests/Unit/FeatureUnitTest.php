<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Feature;
use App\Models\SchoolFeature;
use App\Models\SubscriptionFeature;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $feature = new Feature();
        $this->assertEquals(['feature_name', 'description'], $feature->getFillable());
    }

    /** @test */
    public function it_can_have_many_subscription_features()
    {
        $feature = Feature::factory()->create();
        SubscriptionFeature::factory()->count(3)->create(['feature_id' => $feature->id]);

        $this->assertCount(3, $feature->subscriptionFeatures);
    }

    /** @test */
    public function it_can_have_many_school_features()
    {
        $feature = Feature::factory()->create();
        SchoolFeature::factory()->count(2)->create(['feature_id' => $feature->id]);

        $this->assertCount(2, $feature->schoolFeatures);
    }
}
