<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119102247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, unity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantity_ingredient (quantity_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_BB50A1FA7E8B4AFC (quantity_id), INDEX IDX_BB50A1FA933FE08C (ingredient_id), PRIMARY KEY(quantity_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity_ingredient ADD CONSTRAINT FK_BB50A1FA7E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quantity_ingredient ADD CONSTRAINT FK_BB50A1FA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_ingredient DROP FOREIGN KEY FK_BB50A1FA7E8B4AFC');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('DROP TABLE quantity_ingredient');
    }
}
