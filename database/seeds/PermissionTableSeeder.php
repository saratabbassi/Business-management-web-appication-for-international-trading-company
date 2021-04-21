<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{


$permissions = [

     /*   'Factures',
        
        'Factures payées',
        'Factures partiellement payées',
        'Factures impayées',
        'Employés',
        'Liste des Employés',
        'Autorisations des Employés',
        'Paramètres',
        'Produits',
        'Categories',
        'Devises',
        'Incoterm',
        'Clients',
        'Ajouter Facture',
        'Supprimer Facture',
        'Exporter Excel',
        'Modifié Etat du Paiment',
        'Modifier Facture',
        'Imprimer Facture',
        'Imprimer Liste de Colisage',
        'Imprimer Proforma Facture',
      
        'Ajouter Produit',
        'Modifier Produit',
        'Supprimer Produit',
        'Ajouter Categorie',
        'Modifier Categorie',
        'Supprimer Categorie',
        'Ajouter Client',
        'Modifier Client',
        'Supprimer Client',
        'Ajouter Devise',
        'Modifier Devise',
        'Supprimer Devise',
        'Ajouter Incoterm',
        'Modifier Incoterm',
        'Supprimer Incoterm',
        'Ajouter Image',
        'Supprimer Image',
        'Ajouter Employés',
        'Modifier Employés',
        'Supprimer Employés',
        'Afficher  Permission',
        'Ajouter  Permission',
        'Modifier  Permission',
        'Supprimer  Permission',
        'Notifications',*/



];



foreach ($permissions as $permission) {

Permission::create(['name' => $permission]);
}


}
}