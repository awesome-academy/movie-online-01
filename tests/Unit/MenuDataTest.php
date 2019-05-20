<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Menu;

class MenuDataTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMenuCreate()
    {
        $menu = factory(Menu::class)->create();
        $this->assertInstanceOf(Menu::class, $menu);
        $this->assertDatabaseHas('menus', [
            'name' => $menu->name,
            'slug' => $menu->slug,
            'parent_id' => $menu->parent_id,
        ]);
    }

    public function testShowMenu()
    {
        $menu = factory(Menu::class)->create();
        $this->assertInstanceOf(Menu::class, $menu);
        $found = Menu::findOrFail($menu->id);
        $this->assertEquals($found->name, $menu->name);
        $this->assertEquals($found->slug, $menu->slug);
        $this->assertEquals($found->parent_id, $menu->parent_id);
    }

    public function testMenuUpdate()
    {
        $menu = factory(Menu::class)->create();
        $data = [
            'name' => 'Phim Ma',
        ];
        $this->assertInstanceOf(Menu::class, $menu);
        $menu = Menu::findOrFail($menu->id);
        $success = $menu->update($data);
        $this->assertTrue($success);
        $this->assertDatabaseHas('menus', [
            'name' => $data['name'],
            'slug' => $menu->slug,
            'parent_id' => $menu->parent_id,
        ]);
        $data = [
            'slug' => 'phim-hoat-hinh',
        ];
        $menu = Menu::findOrFail($menu->id);
        $success = $menu->update($data);
        $this->assertTrue($success);
        $this->assertDatabaseHas('menus', [
            'name' => $menu->name,
            'slug' => $data['slug'],
            'parent_id' => $menu->parent_id,
        ]);
    }
    
    public function testMenuDelete()
    {
        $menu = factory(Menu::class)->create();
        $this->assertInstanceOf(Menu::class, $menu);
        $success = $menu->delete();
        $this->assertTrue($success);
        $this->assertDatabaseMissing('menus', [
            'name' => $menu->name,
            'slug' => $menu->slug,
            'parent_id' => $menu->parent_id,
        ]);
    }
}
