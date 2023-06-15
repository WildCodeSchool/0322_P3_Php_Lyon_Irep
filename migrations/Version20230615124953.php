<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615124953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation_exhibition DROP FOREIGN KEY FK_E22D49A826FA52B6');
        $this->addSql('DROP INDEX IDX_E22D49A826FA52B6 ON presentation_exhibition');
        $this->addSql('ALTER TABLE presentation_exhibition CHANGE exhibition_id_id exhibition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presentation_exhibition ADD CONSTRAINT FK_E22D49A82A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('CREATE INDEX IDX_E22D49A82A7D4494 ON presentation_exhibition (exhibition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation_exhibition DROP FOREIGN KEY FK_E22D49A82A7D4494');
        $this->addSql('DROP INDEX IDX_E22D49A82A7D4494 ON presentation_exhibition');
        $this->addSql('ALTER TABLE presentation_exhibition CHANGE exhibition_id exhibition_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presentation_exhibition ADD CONSTRAINT FK_E22D49A826FA52B6 FOREIGN KEY (exhibition_id_id) REFERENCES exhibition (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E22D49A826FA52B6 ON presentation_exhibition (exhibition_id_id)');
    }
}
