<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190525175529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet_client ADD nom_defunt VARCHAR(255) NOT NULL, ADD prenom_defunt VARCHAR(255) NOT NULL, ADD date_naissance_defunt VARCHAR(255) NOT NULL, ADD date_mort_defunt DATETIME NOT NULL, ADD description_defunt VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE projet_client ADD CONSTRAINT FK_E5EDB403BCF5E72D FOREIGN KEY (categorie_id) REFERENCES projet_client_categorie (id)');
        $this->addSql('CREATE INDEX IDX_E5EDB403BCF5E72D ON projet_client (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet_client DROP FOREIGN KEY FK_E5EDB403BCF5E72D');
        $this->addSql('DROP INDEX IDX_E5EDB403BCF5E72D ON projet_client');
        $this->addSql('ALTER TABLE projet_client DROP nom_defunt, DROP prenom_defunt, DROP date_naissance_defunt, DROP date_mort_defunt, DROP description_defunt');
    }
}
