<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605103911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaires ADD closed_lundi TINYINT(1) DEFAULT NULL, ADD closed_mardi TINYINT(1) DEFAULT NULL, ADD closed_mercredi TINYINT(1) DEFAULT NULL, ADD closed_jeudi TINYINT(1) DEFAULT NULL, ADD closed_vendredi TINYINT(1) DEFAULT NULL, ADD closed_samedi TINYINT(1) DEFAULT NULL, ADD closed_dimanche TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaires DROP closed_lundi, DROP closed_mardi, DROP closed_mercredi, DROP closed_jeudi, DROP closed_vendredi, DROP closed_samedi, DROP closed_dimanche');
    }
}
