<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605094407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaires ADD lundi_fermeture TIME DEFAULT NULL, ADD mardi_fermeture TIME DEFAULT NULL, ADD mercredi_fermeture TIME DEFAULT NULL, ADD jeudi_fermeture TIME DEFAULT NULL, ADD vendredi_fermeture TIME DEFAULT NULL, ADD samedi_fermeture TIME DEFAULT NULL, ADD dimanche_fermeture TIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaires DROP lundi_fermeture, DROP mardi_fermeture, DROP mercredi_fermeture, DROP jeudi_fermeture, DROP vendredi_fermeture, DROP samedi_fermeture, DROP dimanche_fermeture');
    }
}
