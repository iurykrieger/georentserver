using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class MessageConfig : EntityTypeConfiguration<Message>
    {
        public MessageConfig()
        {
            ToTable("Message");
        }
    }
}