import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { PruebaComponent } from './prueba/prueba.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { UsuarioComponent } from './usuario/usuario.component';
import { BodyCenterComponent } from './body-center/body-center.component';
import { TemaComponent } from './tema/tema.component';
import { PlaylistComponent } from './playlist/playlist.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatDialogModule, MAT_DIALOG_DEFAULT_OPTIONS} from '@angular/material/dialog';
import { LoginModule } from './usuario/login/login.module';
import { RegistroModule } from './usuario/registro/registro.module';
import { PerfilModule } from './usuario/perfil/perfil.module';
import { SharedModule } from './shared/shared.module';
import { DialogLogin } from './usuario/login/login.component';
import { DialogRegistro } from './usuario/registro/registro.component';

@NgModule({
  declarations: [      
    PruebaComponent, HeaderComponent, FooterComponent, UsuarioComponent, BodyCenterComponent, TemaComponent, PlaylistComponent, DialogLogin, DialogRegistro
  ],
  entryComponents: [DialogLogin, DialogRegistro],
  imports: [
  
    SharedModule,
    AppRoutingModule,

    BrowserModule,
    BrowserAnimationsModule,

    LoginModule, 
    RegistroModule, 
    PerfilModule,
    
  ],
  exports: [ ],
  providers: [
    {provide: MAT_DIALOG_DEFAULT_OPTIONS, useValue: {hasBackdrop: true, direction: 'ltr'}},
    
  ],
  bootstrap: [HeaderComponent,FooterComponent,BodyCenterComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
