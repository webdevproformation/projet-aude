<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422102559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE requete ADD membre_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE requete ADD CONSTRAINT FK_1E6639AA6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1E6639AA6A99F74A ON requete (membre_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE requete DROP FOREIGN KEY FK_1E6639AA6A99F74A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1E6639AA6A99F74A ON requete
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE requete DROP membre_id
        SQL);
    }
}
