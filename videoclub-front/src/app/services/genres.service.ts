import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Global } from './global';

@Injectable({
  providedIn: 'root',
})
export class GenresService {
  public url: string;

  constructor(private _http: HttpClient) {
    this.url = Global.url;
  }

  getGenres(amount: number): Observable<any> {
    let params = new HttpParams().set('cantidad', amount.toString());

    return this._http.get(this.url + '/api/generos', { params: params });
  }

  getMoviesGenre(amount: number, id: number) {
    let params = new HttpParams()
      .set('cantidad', amount.toString())
      .append('id', id);

    return this._http.get(this.url + '/api/generos/' + id + '/peliculas', {
      params: params,
    });
  }
}
