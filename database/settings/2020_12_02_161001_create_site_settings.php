<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSiteSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.title', 'Marketplaceful');
        $this->migrator->add('site.description', null);
        $this->migrator->add('site.icon_path', null);
        $this->migrator->add('site.logo_path', null);
    }
}
