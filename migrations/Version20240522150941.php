<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522150941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Aggiungi la colonna slug, consentendo temporaneamente valori nulli
    $this->addSql('ALTER TABLE conference ADD slug VARCHAR(255)');

    // Aggiorna tutti i record esistenti per impostare un valore di slug
    $this->addSql("UPDATE conference SET slug = CONCAT(LOWER(city), '-', year)");

    // Imposta la colonna slug come NOT NULL
    $this->addSql('ALTER TABLE conference ALTER COLUMN slug SET NOT NULL');

    // Crea un indice unico sulla colonna slug
    $this->addSql('CREATE UNIQUE INDEX UNIQ_911533C8989D9B62 ON conference (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE conference DROP slug');
    }
}
