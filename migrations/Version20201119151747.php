<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119151747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_quantity (recipe_id INT NOT NULL, quantity_id INT NOT NULL, INDEX IDX_E963B3A859D8A214 (recipe_id), INDEX IDX_E963B3A87E8B4AFC (quantity_id), PRIMARY KEY(recipe_id, quantity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_quantity ADD CONSTRAINT FK_E963B3A859D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_quantity ADD CONSTRAINT FK_E963B3A87E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipe_quantity');
    }
}
