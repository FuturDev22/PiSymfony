import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
declare var theme:any;
declare var plugins:any;

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  list: any;
 
  constructor(private http: HttpClient){
    this.http.post( 'http://localhost/DevWeb1/api.php'
    ,    JSON.stringify('')).subscribe((response: any) => {
      this.list=response 
       console.log(this.list)
    });
  }
  ngOnInit(): void {
  
  }

}
