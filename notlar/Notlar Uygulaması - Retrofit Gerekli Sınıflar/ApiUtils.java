package com.info.retrofitkisiler;

/**
 * Created by kasimadalan on 27.02.2017.
 */

public class ApiUtils {

    public static final String BASE_URL = "http://kasimadalan.pe.hu/";

    //bu base link ana link olmalı alt kolları interface içerisinde belirtilir.

    public static KisilerdaoInterface getKisilerDaoInterfeace() {
        return RetrofitClient.getClient(BASE_URL).create(KisilerdaoInterface.class);
    }
}


