using System;
using GeoRent.Domain.Entities;
using System.Collections.Generic;
using System.Runtime.Serialization;
using System.ComponentModel.DataAnnotations.Schema;
using System.ComponentModel.DataAnnotations;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    [Table("City")]
    public class City
    {
        public City()
        {
            idCity = Guid.NewGuid();
        }

        [DataMember]
        [Key]
        public Guid idCity { get; set; }
        [DataMember]
        [Column("name", TypeName = "varchar2")]
        [MaxLength(200)]
        public string name { get; set; }
        [DataMember]
        [Column("uf", TypeName = "varchar2")]
        [MaxLength(2)]
        public String uf { get; set; }
        [DataMember]
        public virtual List<User> Users {get; set;}
}
}