<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Word;
use AppBundle\Entity\Definition;
use AppBundle\Entity\Example;

class LoadTerms implements FixtureInterface
{

    private $em;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $this->em = $em;

        //create and save categories
        //receive an array of them all
        //$categsArray = $this->createCategories();

        //loop over csv
        if (($handle = fopen(__DIR__ . "/dico.csv", "r")) !== FALSE) {
            $num = 0;
            while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num++;
                //skip first line
                if ($num == 1){continue;}

                //remove empty string and NULL strings and NA
                for($i=0;$i<count($cols);$i++){
                    if (empty($cols[$i]) ||  strtoupper($cols[$i]) == "NULL"
                        ||  strtoupper($cols[$i]) == "NA"){
                        $cols[$i] = null;
                    }
                }


                /* mapping
                0"terme"  1"Definition 1" 2"Definition 2"
                3"Catégorie" 4"Exemple #1" 5"Traduction de l'exemple 1"
                6"Variations "  7"Prononciation" 8"nature"
                9"genre" 10"nombre"  11"Origine"  12"Date de création"
                13"Dernière modification"   14"Nombre de votes"
                */

                $term = new Word();
                $term->settheWord($cols[0]);

                /*
                $slugify = new Slugify();
                $slug = $slugify->slugify($term->getName());
                $term->setSlug( $slug );
                */
                //the keys of the array are d,s,v or e...
                //$term->setcategorie( $categsArray[$cols[3]] );
                $term->setMail('er@gmail.com');
                //$term->setVariations($cols[6]);
                
                if (!empty($cols[7])){
                    //$this->addDefinitionToTerm($cols[2], $term);
                    $term->setpronunciation($cols[7]);
                }else{
                    $term->setpronunciation('');
                }

                if (!empty($cols[11])){
                    //$this->addDefinitionToTerm($cols[2], $term);
                    $term->setorigin($cols[11]);
                }else{
                    $term->setorigin('');
                }
                /*$created = new \DateTime();
                //fix empty date
                if (!is_numeric($cols[12]) || !is_numeric($cols[13])){
                    $cols[12] = time();
                    $cols[13] = time();
                }*/
                /*
                $term->setCreatedDate($created->setTimestamp($cols[12]));
                $modified = new \DateTime();
                $term->setModifiedDate($modified->setTimestamp($cols[13]));
                */
                //no votes = 0 vote
                $votes = (empty($cols[14])) ? 0 : $cols[14];
                $term->setvote($votes);

                //definition 1 should always exists
                //$this->addDefinitionToTerm($cols[1], $term);

                $term->setdefinition($cols[1]);

                //def 2 ?
                if (!empty($cols[2])){
                    //$this->addDefinitionToTerm($cols[2], $term);
                    $term->setdefinition2($cols[2]);
                }else{
                    $term->setdefinition2('');
                }
                if (!empty($cols[3])){
                    //$this->addDefinitionToTerm($cols[3], $term);
                    $term->setdefinition3($cols[3]);
                }else{
                    $term->setdefinition3('');
                }
                if (!empty($cols[4])){
                    //$this->addDefinitionToTerm($cols[3], $term);
                    $term->setexample($cols[4]);
                }else{
                    $term->setexample('');
                }
                if (!empty($cols[3])){
                    //$this->addDefinitionToTerm($cols[3], $term);
                    $term->setcategorie($cols[3]);
                }else{
                    $term->setcategorie('');
                }
                $term->setuseOfWord('');
                
                //example ?
                /*if (!empty($cols[4])){
                    $example = new Example();
                    $example->setCreatedDate( $term->getCreatedDate() );
                    $example->setModifiedDate( $term->getModifiedDate() );
                    $example->setContent($cols[4]);
                    $example->setTranslation($cols[5]);
                    $example->setTerm($term);
                    $em->persist($example);

                    $term->addExample($example);
                }*/

                //saves it
                $em->persist($term);
            }
            $em->flush();
            fclose($handle);
        }
    }

    /**
     * Adds a definition to a term
     *
     * @param $content
     * @param Term $term
     */
    private function addDefinitionToTerm($content, Term $term)
    {
        $def = new Definition();
        $def->setContent( $content );
        $def->setTerm($term);
        $def->setCreatedDate( $term->getCreatedDate() );
        $def->setModifiedDate( $term->getModifiedDate() );
        $this->em->persist($def);
        $term->addDefinition($def);
    }

    /**
     * Creates all categories, and return an array containing refs
     *
     * @return array
     */
    private function createCategories()
    {

        $categsArray = array();

        $v = new Category("Vocabulaire");
        $e = new Category("Expressions");
        $s = new Category("Sacres");
        $d = new Category("Déformations");

        $this->em->persist($v);
        $this->em->persist($e);
        $this->em->persist($s);
        $this->em->persist($d);
        $this->em->flush();

        $categsArray['v'] = $v;
        $categsArray['e'] = $e;
        $categsArray['s'] = $s;
        $categsArray['d'] = $d;

        return $categsArray;
    }
}