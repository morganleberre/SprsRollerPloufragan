<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        // Notre modification est ICI !

        // DEUXIEME modification est ICI !

            parent::__construct();
            if(!($this->session->profil=='A'))
            {
             redirect('Visiteur/Connexion','Refresh');
            }
    } // __construct
   public function AjouterUnProduit()
   {
          $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
       $Donnesinjectees['LesTailles']=$this->modeleTaille->RetournerLesTailles();
       $Donnesinjectees['TitreDeLaPage']='Ajouter Un Produit';
       $Donnesinjectees['LesCategories']=$this->modeleCategorie->RetournerCategories();
       if($this->input->post('BtnAjouter'))
       {
        $DonnesAinserer=array(
         'LIBELLE'=>$this->input->post('txtLibelle'),
         'DETAIL'=>$this->input->post('txtDetail'),
         'PRIXHT'=>$this->input->post('txtPrixHT'),
         'TAUXTVA'=>20,
         'NOMIMAGE'=>$this->input->post('txtImage'),
         'QUANTITEENSTOCK'=>$this->input->post('txtQuantiteenstock'),
         'DATEAJOUT'=>$this->input->post('txtDateAjout'),
         'DISPONIBLE'=>$this->input->post('txtDispo'),
         'NOCATEGORIE'=>$this->input->post('txtNoCategorie')
        );
        $NoProduit=$this->modeleProduit->InsererUnProduit($DonnesAinserer);
        $Donnesainserer=array(
            'NOTAILLE'=>$this->input->post('txtNoTaille'),
            'NOPRODUIT'=>$NoProduit
           );
           $this->modeleTaille->AssignerUnetaille($Donnesainserer);
        redirect('Admin/AfficherLesProduit');
       }
       else
       {
        $this->load->view('templates/Entete');
        $this->load->view('admin/AjouterUnProduit',$Donnesinjectees);
       $this->load->view('templates/PiedDePage',$Data);
       }
   }
   public function AfficherLesProduit()
   {
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $config=array();
    $config["base_url"] = site_url('Admin/AfficherLesProduits');
    $config["total_rows"] =$this->modeleProduit->NombreDeProduit();
    $config["per_page"] = 5;
    $config["uri_segment"] = 3; 
    $config['first_link'] = 'Premier';

    $config['last_link'] = 'Dernier';
  
    $config['next_link'] = 'Suivant';
  
    $config['prev_link'] = 'Précédent';
    
    $this->pagination->initialize($config);

    $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 $DonneesInjectees['TitreDeLaPage'] = 'Les produits';
  $DonneesInjectees["LesProduits"]=$this->modeleProduit->retournerProduitLimite($config["per_page"],$noPage);
  $DonneesInjectees["LiensPagination"]=$this->pagination->create_links();

  $this->load->view('templates/Entete');

  $this->load->view('admin/ListeDesProduits',$DonneesInjectees);

 $this->load->view('templates/PiedDePage',$Data);
   }
public function AjouterUneCategorie()
{
 $Donnesinjectees['TitreDeLaPage']='Ajouter Un Produit';
 $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
if ($this->input->post('BtnAjouter'))
{
    $DonnesAinserer=array('Libelle'=>$this->input->post('txtLibelle'));
    var_dump($DonnesAinserer);
$this->modeleCategorie->insererUneCategorie($DonnesAinserer);
redirect('Admin/AjouterUnProduit');
}
else
{
    $this->load->view('templates/Entete');

    $this->load->view('admin/AjouterUneCategorie',$Donnesinjectees);
  
   $this->load->view('templates/PiedDePage',$Data);

}
}
public function ModifierUnProduit($NoProduit=false)
{
$Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['LeProduit']=$this->modeleProduit->retournerLeProduit($NoProduit);
$DonneesInjectees['LesCategorie']=$this->modeleCategorie->RetournerCategories();
$DonneesInjectees['TitreDeLaPage']='Modifier un produit';

if($this->input->post('BtnModifier'))
{
    $DonnesAinserer=array(
        'LIBELLE'=>$this->input->post('txtLibelle'),
        'DETAIL'=>$this->input->post('txtDetail'),
        'PRIXHT'=>$this->input->post('txtPrixHT'),
        'TAUXTVA'=>20,
        'NOMIMAGE'=>$this->input->post('txtImage'),
        'QUANTITEENSTOCK'=>$this->input->post('txtQuantiteenstock'),
        'DATEAJOUT'=>$this->input->post('txtDateAjout'),
        'DISPONIBLE'=>$this->input->post('txtDispo'),
        'NOCATEGORIE'=>$this->input->post('txtNoCategorie')
       );
 $this->modeleProduit->ModifierunProduit($DonnesAinserer,$NoProduit);
 redirect('Admin/AfficherLesProduit');
}
else
{
    $this->load->view('templates/Entete');

    $this->load->view('admin/ModifierLeProduit',$DonneesInjectees);
    
    $this->load->view('templates/PiedDePage',$Data);   
}
}

public function AjouterUnjoueur()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['TitreDeLaPage']='ajouter un joueur';
    if($this->input->post('BtnAjouter'))
    {
        $DonnesAinserer=array(
         'NOM'=>$this->input->post('txtNom'),
         'PRENOM'=>$this->input->post('txtPrenom'),
         'VILLE'=>$this->input->post('txtVille'),
         'ADRESSE'=>$this->input->post('txtAdresse'),     
          'CODEPOSTAL'=>$this->input->post('txtCodepostal'),
          'EMAIL'=>$this->input->post('txtEmail'),
          'MOTDEPASSE'=>$this->input->post('txtMdp'),
          'PROFIL'=>'J'
        );
     $NoJoueur=$this->modeleAdherent->insererUnAdherent($DonnesAinserer);
     $Donnesdujoueur=array(
        'NOADHERENT'=>$NoJoueur,
        'IMAGEJOUEUR'=>$this->input->post('txtPhoto'),
        'BIOGRAPHIE'=>$this->input->post('txtBio')
     );
     $this->modeleAdherent->insererUnJoueur($Donnesdujoueur);
     $this->load->view('templates/Entete');
    $this->load->view('admin/InsertionReussie');
   $this->load->view('templates/PiedDePage',$Data);
    }
    else
    {
        $this->load->view('templates/Entete');

        $this->load->view('admin/AjouterUnjoueur',$DonneesInjectees);
        
       $this->load->view('templates/PiedDePage',$Data);

    }
}
public function AjouterUneLigue()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['TitreDeLaPage']='AjouterUneLigue';
    if($this->input->post('BtnAjouter'))
    {
     $DonnesAinserer=array(
         'Nomligue'=>$this->input->post('txtNomLigue')
     );
     $this->modeleLigue->insererUneLigue($DonnesAinserer);
     redirect('Admin/AjouterUneEquipe');
    }
    else
    {
        $this->load->view('templates/Entete');

        $this->load->view('admin/AjouterUneLigue',$DonneesInjectees);
        
       $this->load->view('templates/PiedDePage',$Data);
    }
}
public function AjouterUnUtilisateur()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['TitreDeLaPage']='Ajouter Un Admin ou Un Entraineur';
    if($this->input->post('BtnAjouter'))
    {
     $DonnesAinserer=array(
     'NOM'=>$this->input->post('txtNom'),
     'PRENOM'=>$this->input->post('txtPrenom'),
     'VILLE'=>$this->input->post('txtVille'),
     'ADRESSE'=>$this->input->post('txtAdresse'),
     'CODEPOSTAL'=>$this->input->post('txtCodepostal'),
     'EMAIL'=>$this->input->post('txtEmail'),
     'MOTDEPASSE'=>$this->input->post('txtMdp'),
     'PROFIL'=>$this->input->post('txtType')
     );
     $this->modeleAdherent->insererUnAdherent($DonnesAinserer);
     $this->load->view('templates/Entete');
     $this->load->view('admin/InsertionReussie');
    $this->load->view('templates/PiedDePage',$Data);
    }
    else
    {
        $this->load->view('templates/Entete');

        $this->load->view('admin/AjouterUnUtilisateur',$DonneesInjectees);
        
        $this->load->view('templates/PiedDePage',$Data);
    }

}
public function AjouterUneEquipe()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['TitreDeLaPage']='Ajouter une equipe';
    $DonneesInjectees['LesEntraineur']=$this->modeleAdherent->RetournerlesEntraineur();
    $DonneesInjectees['LesLigues']=$this->modeleLigue->RetournerLesLigue();

    if ($this->input->post('BtnAjouter'))
    {
        $DonnesAinserer=array(
           'NOMEQUIPE'=>$this->input->post('txtNom'),
            'IMAGE'=>$this->input->post('txtImage'),
            'NOADHERENT'=>$this->input->post('txtNoEntraineur'),
            'NOLIGUE'=>$this->input->post('txtNoLigue')
        );
        $this->modeleEquipe->insererUneEquipe($DonnesAinserer);
        $this->load->view('templates/Entete');
        $this->load->view('admin/InsertionReussie');
       $this->load->view('templates/PiedDePage',$Data);
    }
    else    
    {
        $this->load->view('templates/Entete');

        $this->load->view('admin/AjouterUneEquipe',$DonneesInjectees);
        
        $this->load->view('templates/PiedDePage',$Data);
    }
}

public function AjouterUnSponsor()
{
    $DonneesInjectees['TitreDeLaPage']='Ajouter une equipe';
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();

    if($this->input->post('BtnAjouter'))
     {
        $DonnesAinserer=array(
        'NOMSPONSOR'=>$this->input->post('txtNomSponso'),
        'IMAGE'=>$this->input->post('txtLogo'),
        'EMAIL'=>$this->input->post('txtEmail'),
        'SITEWEB'=>$this->input->post('txtSite')
         );
         $this->modeleSponsor->insererUnSponsor($DonnesAinserer);
         $this->load->view('templates/Entete');
         $this->load->view('admin/InsertionReussie');
        $this->load->view('templates/PiedDePage',$Data);

     }
    else
    {

        $this->load->view('templates/Entete');

        $this->load->view('admin/AjouterUnSponsor',$DonneesInjectees);
        
        $this->load->view('templates/PiedDePage',$Data);

    }




}
public function ListerLesEquipes()
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['LesEquipes']=$this->modeleEquipe->RetournerLesEquipes();
$DonneesInjectees['TitreDeLaPage']='Les Equipes';

$this->load->view('templates/Entete');

$this->load->view('admin/ListerlesEquipes',$DonneesInjectees);

$this->load->view('templates/PiedDePage',$Data);

}
public function ModifierUneEquipe($NoEquipe=FALSE)
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['Equipe']=$this->modeleEquipe->RetournerUneEquipe($NoEquipe);
$DonneesInjectees['TitreDeLaPage']='Modifier Equipe';
$DonneesInjectees['LesEntraineur']=$this->modeleAdherent->RetournerlesEntraineur();
$DonneesInjectees['LesLigues']=$this->modeleLigue->RetournerLesLigue();
if($this->input->post('BtnModifier'))
{
 $DonnesAModifier=array(
 'NOMEQUIPE'=>$this->input->post('txtNom'),
 'IMAGE'=>$this->input->post('txtImage'),
 'NOLIGUE'=>$this->input->post('txtNoLigue'),
 'NOADHERENT'=>$this->input->post('txtNoEntraineur')
 );
 $this->modeleEquipe->ModifierUneEquipe($NoEquipe,$DonnesAModifier);
}
else
{
    $this->load->view('templates/Entete');

    $this->load->view('admin/ModifierUneEquipe',$DonneesInjectees);
    
    $this->load->view('templates/PiedDePage',$Data);  
}

}
public function AjouterUnEvenement()
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['LesEquipes']=$this->modeleEquipe->RetournerLesEquipes();
  if($this->input->post('btnAjouter'))
  {
  $DonnesAinserer=array(
  'DATEEVENEMENT'=>$this->input->post('txtDateEvenement'),
  'NOMEVENEMENT'=>$this->input->post('txtNomEvenement'),
  'DETAILEVENEMENT'=>$this->input->post('txtDetail'),
   'NOMIMAGE'=>$this->input->post('txtImage'),
   'LIEN'=>$this->input->post('txtlien'),
    'NOEQUIPE'=>$this->input->post('txtnoEquipe')
  );
 $this->modeleEvenement->insererUnEvenement($DonnesAinserer);
 $this->load->view('templates/Entete');

 $this->load->view('admin/InsertionReussie');
 
 $this->load->view('templates/PiedDePage',$Data);
  }
  else
  {
    $this->load->view('templates/Entete');

    $this->load->view('admin/AjouterUnEvenement',$DonneesInjectees);
    
    $this->load->view('templates/PiedDePage',$Data);
  }
}
public function AjouterUneTaille()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
 if($this->input->post('BtnAjouter'))
 {
 $DonnesAinserer=array('NOMTAILLE'=>$this->input->post('txtTaille'));
 $this->modeleTaille->InsererUneTaille($DonnesAinserer);
 $this->load->view('templates/Entete');
 $this->load->view('admin/InsertionReussie'); 
$this->load->view('templates/PiedDePage',$Data);
 }
 else
 {
    $this->load->view('templates/Entete');
    $this->load->view('admin/AjouterUneTaille'); 
   $this->load->view('templates/PiedDePage',$Data);
 }
}
public function ListedesCommandes()
{
       $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
 $DonneesInjectees['LesCommandes']=$this->modeleCommande->AfficherLesCommandes();
 $DonneesInjectees['Titredelapage']='Les Commandes';
 $this->load->view('templates/Entete');
 $this->load->view('admin/ListerLesCommandes',$DonneesInjectees); 
$this->load->view('templates/PiedDePage',$Data);
}
public function DetaildeLaCommande($Nocommande=null)
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['LaCommande']=$this->modeleCommande->AfficheUneCommande($Nocommande);
$DonneesInjectees['Titredelapage']='La Commande';
$DonneesInjectees['PRIXTOTAL']=$this->modeleCommande->CalculPrixTotal($Nocommande);
if($this->input->post('btnTraitement'))
{
$DateTraitement=date("Y-m-d H:i:s");
$lesproduits=$this->modeleCommande->AfficheUneCommande($Nocommande);
$Email=$lesproduits[0]->EMAIL;
foreach ($lesproduits as $unproduit)
{
$donneesamodifier=array(
'NOPRODUIT'=>$unproduit->NOPRODUIT,
'QUANTITECOMMANDEE'=>$unproduit->QUANTITECOMMANDEE
);
$this->modeleProduit->ModifierStockunProduit($donneesamodifier['NOPRODUIT'],$donneesamodifier['QUANTITECOMMANDEE']);
}
$msg = "Boujour Votre Commande ".$Nocommande." est traités:";
$this->email->from('Morganlb347@gmail.com');
$this->email->to($Email);
$this->email->subject('Votre commande  est Traités:');
foreach ($lesproduits as $Unproduit)
{
$Prixtotal=$Prixtotal+$prixproduit;
$Nom=$Unproduit->LIBELLE;
$msg .='</BR>';
$msg .='Nom du produit:';
$msg .=$Nom;
$msg .='</BR>';
$msg .='prix:';
$msg .=$Unproduit->PRIXTTC;
$msg .='€';
$msg .='</BR>';
};
$msg .='prix total:';
$msg .=$Prixtotal;
$msg .='€';
$msg .='</BR>';
$this->email->message($msg.'Pour Retirer les produits et régler la commande');
if($this->email->send()){
    $this->modeleCommande->TraitementDeLaCommande($Nocommande,$DateTraitement);
    redirect('Admin/ListedesCommandes');
  }
  else{
     $this->email->print_debugger();
  }       
}
else
{
$this->load->view('templates/Entete');
$this->load->view('admin/DetailCommande',$DonneesInjectees); 
$this->load->view('templates/PiedDePage',$Data); 
}
}
public function listerLesjoueursAModifier()
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['LesJoueurs']=$this->modeleEquipe->ListerLesJoueurs();
$this->load->view('templates/Entete');
$this->load->view('admin/ListerJoueurs',$DonneesInjectees); 
$this->load->view('templates/PiedDePage',$Data); 
}
public function Modifierunjoueur($NoJoueur)
{
$Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['LeJoueur']=$this->modeleEquipe->AfficherJoueur($NoJoueur);
$LeJoueur=$this->modeleEquipe->AfficherJoueur($NoJoueur);
$this->load->view('templates/Entete');
$this->load->view('admin/Modifierunjoueur',$DonneesInjectees); 
$this->load->view('templates/PiedDePage',$Data);
if($this->input->post('BtnModifier'))
{
$Donneesjoueur=array(
'BIOGRAPHIE'=>$this->input->post('txtBio'),
'IMAGEJOUEUR'=>$this->input->post('txtPhoto')
);
$this->modeleEquipe->ModifierUnJoueur($NoJoueur,$Donneesjoueur);
$Donnesutilisateur=array(
'NOM'=>$this->input->post('txtNom'),
'PRENOM'=>$this->input->post('txtPrenom')
);
$this->modeleAdherent->ModifierunAdherent($Donnesutilisateur,$LeJoueur->NOADHERENT);
redirect('Admin/listerLesjoueursAModifier');
}
else
{
    $this->load->view('templates/Entete');
    $this->load->view('admin/Modifierunjoueur',$DonneesInjectees); 
    $this->load->view('templates/PiedDePage',$Data);  
}
}
public function listerLesjoueuraAjouter($NoEquipe=null)
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
$DonneesInjectees['LesJoueurs']=$this->modeleEquipe->ListerLesJoueursAjouter($NoEquipe);
$DonneesInjectees['NOEQUIPE']=$NoEquipe;
$DonneesInjectees['TitredeLaPage']='Ajouter Les Joueur';
$this->load->view('templates/Entete');
$this->load->view('admin/AjoutJoueurEquipe',$DonneesInjectees); 
$this->load->view('templates/PiedDePage',$Data); 
}
public function  listerLesjoueuraEnlever($NoEquipe=null)
{
    $Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $DonneesInjectees['LesJoueurs']=$this->modeleEquipe->ListerLesJoueurEquipe($NoEquipe);
    $DonneesInjectees['NOEQUIPE']=$NoEquipe;
    $DonneesInjectees['TitredeLaPage']='Ajouter Les Joueur';
    $this->load->view('templates/Entete');
    $this->load->view('admin/SupprimerJoueurEquipe',$DonneesInjectees); 
    $this->load->view('templates/PiedDePage',$Data);   
}
public function AjouterJoueurEquipe($NoJoueur,$NoEquipe)
{
$DonnesAinserer=array(
'NOJOUEUR'=>$NoJoueur,
'NOEQUIPE'=>$NoEquipe
);
$this->modeleEquipe->AjouterJoueurUneEquipe($DonnesAinserer);
redirect('Admin/ListerLesEquipes');
}
public function SupprimerJoueurEquipe($NoJoueur,$NoEquipe)
{
$this->modeleEquipe->SupprimerJoueurUneEquipe($NoJoueur,$NoEquipe);
redirect('Admin/ListerLesEquipes');
}

public function ListerLesSponsor()
{
    $DonneesInjectees['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
    $this->load->view('templates/Entete');
    $this->load->view('admin/ListerLesSponsor',$DonneesInjectees); 
    $this->load->view('templates/PiedDePage',$DonneesInjectees);  
}
public function ModifierLeSponsor($Nosponsor=null)
{
$DonneesInjectees['LeSponsor']=$this->modeleSponsor->RetournerLeSponsor($Nosponsor);
$Data['LesPartenaires']= $this->modeleSponsor->RetournerLesSponsors();
if($this->input->post('BtnModifier'))
{
    $DonnesAModifier=array(
        'NOMSPONSOR'=>$this->input->post('txtNomSponso'),
        'IMAGE'=>$this->input->post('txtLogo'),
        'EMAIL'=>$this->input->post('txtEmail'),
        'SITEWEB'=>$this->input->post('txtSite')
         );
         $this->modeleSponsor->ModifierLeSponsor($Nosponsor,$DonnesAModifier);
         redirect('Admin/ListerLesSponsor');
}
else
{
    $this->load->view('templates/Entete');
    $this->load->view('admin/ModifierLeSponsor',$DonneesInjectees); 
    $this->load->view('templates/PiedDePage',$Data);   
}
}
}

/* End of file Controllername.php */
