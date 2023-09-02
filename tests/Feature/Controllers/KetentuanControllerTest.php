<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Ketentuan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KetentuanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_ketentuans(): void
    {
        $ketentuans = Ketentuan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('ketentuans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.ketentuans.index')
            ->assertViewHas('ketentuans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_ketentuan(): void
    {
        $response = $this->get(route('ketentuans.create'));

        $response->assertOk()->assertViewIs('app.ketentuans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_ketentuan(): void
    {
        $data = Ketentuan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('ketentuans.store'), $data);

        $this->assertDatabaseHas('ketentuans', $data);

        $ketentuan = Ketentuan::latest('id')->first();

        $response->assertRedirect(route('ketentuans.edit', $ketentuan));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_ketentuan(): void
    {
        $ketentuan = Ketentuan::factory()->create();

        $response = $this->get(route('ketentuans.show', $ketentuan));

        $response
            ->assertOk()
            ->assertViewIs('app.ketentuans.show')
            ->assertViewHas('ketentuan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_ketentuan(): void
    {
        $ketentuan = Ketentuan::factory()->create();

        $response = $this->get(route('ketentuans.edit', $ketentuan));

        $response
            ->assertOk()
            ->assertViewIs('app.ketentuans.edit')
            ->assertViewHas('ketentuan');
    }

    /**
     * @test
     */
    public function it_updates_the_ketentuan(): void
    {
        $ketentuan = Ketentuan::factory()->create();

        $data = [
            'nama_ketentuan' => $this->faker->text(255),
        ];

        $response = $this->put(route('ketentuans.update', $ketentuan), $data);

        $data['id'] = $ketentuan->id;

        $this->assertDatabaseHas('ketentuans', $data);

        $response->assertRedirect(route('ketentuans.edit', $ketentuan));
    }

    /**
     * @test
     */
    public function it_deletes_the_ketentuan(): void
    {
        $ketentuan = Ketentuan::factory()->create();

        $response = $this->delete(route('ketentuans.destroy', $ketentuan));

        $response->assertRedirect(route('ketentuans.index'));

        $this->assertModelMissing($ketentuan);
    }
}
