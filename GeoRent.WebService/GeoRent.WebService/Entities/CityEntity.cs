using System;
using GeoRentWebService.Entities;
using System.Collections.Generic;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class CityEntity
    {
        private Nullable<int> idCity;
        private String name;
        private String uf;
        public virtual List<UserEntity> User { get; set; }

        [DataMember]
        public int? IdCity
        {
            get { return idCity; }
            set { idCity = value; }
        }
        [DataMember]
        public String Name
        {
            get { return name; }
            set { name = value; }
        }
        [DataMember]
        public String UF
        {
            get { return uf; }
            set { uf = value; }
        }
    }
}