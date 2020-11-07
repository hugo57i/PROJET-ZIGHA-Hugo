import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { Produit } from '../produit';
import { Store } from '@ngxs/store';
import { ProductState } from '../states/product-state';
import { DelProduct } from '../actions/product-action';

@Component({
  selector: 'app-panier',
  templateUrl: './panier.component.html',
  styleUrls: ['./panier.component.css']
})
export class PanierComponent implements OnInit {

  listProducts$: Observable<Produit>;
  nbProducts$: number;
  total$: number = 0;
  constructor(private store: Store) { }

  ngOnInit() {
    this.listProducts$ = this.store.select(state => state.listProducts.products);
    this.store.select(ProductState.getNbProducts).subscribe(
      (products: number) => {
          this.nbProducts$ = products;
      }
     );
    this.store.select(ProductState.getTotalPrices).subscribe(
    (price: number) => {
        this.total$ = price;
    }
    );
  }

  public onDelFromCart(product: {id: number, nom: string, prix: number, type: string, categorie: string, pathImg: string, description: string}): void {
    this.delProduct(product.id, product.nom, product.prix, product.type, product.categorie, product.pathImg, product.description);
  }

  private delProduct(id: number, nom: string, prix: number, type: string, categorie: string, pathImg: string, description: string): void {
    const quantite = 1;
    this.store.dispatch(new DelProduct({ id, nom, prix, type, categorie, pathImg, quantite, description}));
  }

}
