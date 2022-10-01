package tn.esprit.produit_demo.entities;

import javax.persistence.*;
import java.io.Serializable;
import java.util.Date;

@Entity
public class Produit {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long idProduit;
    private String nomProduit;
    private Double prixProduit;
    private Date dateCreation;
    @ManyToOne
    private  Categorie categorie;

    public Categorie getCategorie() {
        return categorie;
    }

    public void setCategorie(Categorie categorie) {
        this.categorie = categorie;
    }


    public Produit(){
        super();
    }
    public Produit( String nomProduit, Double prixProduit, Date dateCreation) {
        super();
        this.nomProduit = nomProduit;
        this.prixProduit = prixProduit;
        this.dateCreation = dateCreation;
    }

    public Long getIdProduit() {
        return idProduit;
    }

    public String getNomProduit() {
        return nomProduit;
    }

    public Double getPrixProduit() {
        return prixProduit;
    }

    public Date getDateCreation() {
        return dateCreation;
    }

    public void setIdProduit(Long idProduit) {
        this.idProduit = idProduit;
    }

    public void setNomProduit(String nomProduit) {
        this.nomProduit = nomProduit;
    }

    public void setPrixProduit(Double prixProduit) {
        this.prixProduit = prixProduit;
    }

    public void setDateCreation(Date dateCreation) {
        this.dateCreation = dateCreation;
    }

    @Override
    public String toString() {
        return "Produit{" +
                "idProduit=" + idProduit +
                ", nomProduit='" + nomProduit + '\'' +
                ", prixProduit=" + prixProduit +
                ", dateCreation=" + dateCreation +
                '}';
    }
}
