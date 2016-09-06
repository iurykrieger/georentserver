using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class Like
    {
        public Like()
        {
            idLike = Guid.NewGuid();
        }

        [DataMember]
        public Guid idLike { get; set; }
        [DataMember]
        public bool like { get; set; }
        [DataMember]
        public DateTime dateTime { get; set; }
        [DataMember]
        public bool diamond { get; set; }
        [DataMember]
        public virtual Residence Residence { get; set; }
        [DataMember]
        public virtual User idUser { get; set; }
    }
}