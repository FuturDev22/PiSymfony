package tn.esprit.produit_demo;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import tn.esprit.produit_demo.entities.Produit;
import tn.esprit.produit_demo.repository.ProduitRepository;

import java.util.Date;
import java.util.List;

@SpringBootTest
class ProduitDemoApplicationTests {
    @Autowired
    private ProduitRepository produitRepository;
    @Test
    public void testCreateProduit() {
        Produit prod = new Produit("PC Dell",2200.500,new Date());
        produitRepository.save(prod);
    }

    @Test
    public void testFindProduit()
    {
        Produit p = produitRepository.findById(1L).get();
        System.out.println(p);
    }
    @Test
    public void testUpdateProduit()
    {
        Produit p = produitRepository.findById(1L).get();
        p.setPrixProduit(1000.0);
        produitRepository.save(p);
    }
    @Test
    public void testDeleteProduit(){
        produitRepository.deleteById(1L);
    }
    @Test
    public void testListerTousProduits()
    {
        List<Produit> prods = produitRepository.findAll();
        for (Produit p : prods)
        {
            System.out.println(p);
        }
    }
}
