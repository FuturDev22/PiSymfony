package tn.esprit.produit_demo.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import tn.esprit.produit_demo.entities.Produit;

public interface ProduitRepository extends JpaRepository<Produit,Long> {



}
