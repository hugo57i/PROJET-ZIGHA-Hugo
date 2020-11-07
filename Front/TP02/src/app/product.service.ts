import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Produit } from './produit';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  public products: [];
  constructor(private http: HttpClient) {
   }


  getAllProducts(): Observable<any> {
      return this.http.get('/assets/catalogue.json');
  }

  async getOneProduct(id: number): Promise<Produit> {
    return new Promise((resolve, reject) => {
      const catalogue = this.http.get('/assets/catalogue.json');
      catalogue.subscribe( products => {
        resolve(products[id - 1]);
      });
    });
  }
}
